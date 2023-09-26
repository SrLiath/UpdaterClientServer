function calculateHashesRecursively($directory) {
            $hashes = array();

            if (is_dir($directory)) {
                if ($handle = opendir($directory)) {
                    while (($file = readdir($handle)) !== false) {
                        if ($file != "." && $file != "..") {
                            $path = $directory . '/' . $file;
                            if (is_file($path)) {
                                $hashes[$file] = hash_file('sha256', $path);
                            } elseif (is_dir($path)) {
                                $hashes[$file] = calculateHashesRecursively($path);
                            }
                        }
                    }
                    closedir($handle);
                }
            }

            return $hashes;
        }

        $directory = 'files';
        $hashes = calculateHashesRecursively($directory);

        $result = array('file_hashes' => $hashes);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($result, JSON_PRETTY_PRINT);