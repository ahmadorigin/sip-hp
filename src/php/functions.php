<?php
    
    // Koneksi ke database
    $supabaseUrl = "https://pxvsiuvzwbejefpkpdkt.supabase.co";
    $supabaseKey = "sb_publishable_z83sd2gzkxijRQZISaeMAA_a4O3hsCc";
    
    function s_query($method, $endPoint, $data = null) {
        global $supabaseUrl, $supabaseKey;

        $ch = curl_init($supabaseUrl . $endPoint);

        $headers = [
            "apikey: $supabaseKey",
            "Authorization: Bearer $supabaseKey",
            "Content-Type: application/json",
            "Prefer: return=representation",
            "X-HTTP-Method-Override: $method"
        ];

        if ($data !== null) {
            $payload = json_encode($data);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
            
            $headers[] = "Content-Length: " . strlen($payload);
        }
        
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        $error = curl_error($ch);

        if($error) {
            return "CURL Error : " . $error;
        }

        return json_decode($response, true);
    }

    function filter($data) {
        global $supabaseUrl, $supabaseKey;

        date_default_timezone_set('Asia/Jakarta');
        
        $filterKata = ["Ngaji", "Belajar", "Tugas"];
        $filterKataAda = false;

        foreach($filterKata as $kata) {
            if(stripos($data["alasan"], $kata) !== false) {
                $filterKataAda = true;
                break;
            }
        }

        $output = "";
        $approved = false;

        if( intval(date("H")) > 21 ) {
            $output = "ini sudah jam tidur!!!";
        } else if($data["durasi-pinjam"] > 30) {
            $output = "Durasi pinjam mu kelamaan!!";
        } else if($filterKataAda === true) {
            $output = "Selamat belajar dan ber-ibadah ";
            $approved = true;
        } else {
            $output = "Pending (menunggu persetujuan...) sabar dulu ya ";
        }

        // menambah data
        $dataFilter = [
            "peminjam" => $data["peminjam"],
            "durasi" => $data["durasi-pinjam"],
            "alasan" => $data["alasan"],
            "status"   => $output, // Isinya: "Pending (menunggu persetujuan...)"
            "approved" => $approved
        ];

        return $dataFilter;
    }
        
    function tambah($data) {
        $dataBaru = filter($data);
        return s_query("POST", "/rest/v1/tb_peminjaman", $dataBaru);
    }

    function hapusData($id) {
        return s_query("DELETE", "/rest/v1/tb_peminjaman?id=eq." . $id);
    }

    function ubahData($id, $data) {
        $dataFilter = filter($data);

        $dataUpdate = [
            "peminjam" => $dataFilter["peminjam"],
            "durasi" => $dataFilter["durasi"],
            "alasan" => $dataFilter["alasan"],
            "status"   => $dataFilter["status"],
            "approved" => $dataFilter["approved"]
        ];

        return s_query("PATCH", "/rest/v1/tb_peminjaman?id=eq." . $id, $dataUpdate);
    }

    function registrasi($data) {
        // 1. Ambil data & bersihkan spasi/karakter aneh dasar
        $username = strtolower(stripslashes(trim($data["username"])));
        $password = $data["password"];
        $password2 = $data["password2"];
        
        // 2. Cek username ganda (Pakai GET ke Supabase)
        $cekUser = s_query("GET", "/rest/v1/tb_users?username=eq." . $username);

        // Jika hasil GET tidak kosong, berarti username sudah ada
        if (!empty($cekUser)) {
            echo "<script>alert('Username mu pdo karo sing lio!');</script>";
            return false;
        }

        // 3. Cek kesamaan password
        if ($password !== $password2) {
            echo "<script>alert('Password ra podo!');</script>";
            return false;
        }

        // 4. Enkripsi password 
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // 5. Masukkan data ke Supabase (Pakai POST)
        $dataBaru = [
            "username" => $username,
            "password" => $passwordHash
        ];

        $result = s_query("POST", "/rest/v1/tb_users", $dataBaru);

        // Di Supabase, jika sukses POST biasanya mengembalikan data yang diinput
        // Jika ada error, biasanya ada field 'code' atau 'message'
        if (isset($result['code'])) {
            return false;
        }

        return true; // Berhasil
    }

    function login($data) {
        $username = strtolower(stripslashes(trim($data["username"])));
        $password = $data["password"];

        // 1. Cari user berdasarkan username
        $result = s_query("GET", "/rest/v1/tb_users?username=eq." . $username);

        if (!empty($result)) {
            $row = $result[0];

            // 2. Cek apakah password cocok dengan hash di DB
            if (password_verify($password, $row["password"])) {

                if ($row["role"] === "admin") {
                    $_SESSION["admin"] = true;
                }

                $_SESSION["login"] = true;
                $_SESSION["username"] = $row["username"];
                $_SESSION["id"] = $row["id"];

                // cek remember
                if (isset($_POST["remember"])) {
                    // buat cookie
                    setcookie('id', $row["id"], time() + 120);
                    setcookie('key', hash('sha256', $row["username"]), time() + 120);
                }

                return $row; // Kembalikan data user jika sukses
            }
        }

        return false;
    }

    function verify($data) {
        
        $id = $data["id"];
        $password = $data["password"];

        $result = s_query("GET", "/rest/v1/tb_users?id=eq." . $id);

        if (!empty($result)) {
            $row = $result[0];

            if (password_verify($password, $row["password"])) {

                $_SESSION["login"] = true;
                $_SESSION["username"] = $row["username"];
                $_SESSION["id"] = $row["id"];

                setcookie('id', $row["id"], time() + 120);
                setcookie('key', hash('sha256', $row["username"]), time() + 120);

                return $row; // Kembalikan data user jika sukses
            }
        }

        return false;
    }