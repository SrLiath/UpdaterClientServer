# Atualizador - Application Readme

## Overview

The Atualizador application is a Java-based update utility designed to keep your software up-to-date by checking for updates from a remote server and automatically downloading and applying them. This readme provides detailed information on how to use, customize, and deploy the Atualizador application.

## Table of Contents

1. [Features](#features)
2. [Requirements](#requirements)
3. [Installation](#installation)
4. [Usage](#usage)
5. [Customization](#customization)
6. [Server-Side](#server-side)
7. [Troubleshooting](#troubleshooting)
8. [Contributing](#contributing)
9. [License](#license)

## Features

- Automatic checking for software updates.
- Secure file download and update verification using SHA-256 hashes.
- Customizable GUI with logo and background image.
- Supports recursive file hashing for updates.
- Execute in sequence another application before check a local port.
## Requirements

Before using the Atualizador application, ensure that you have the following prerequisites:

- Java Development Kit (JDK) installed on the client machine.
- A server-side script (e.g., PHP) to calculate and provide file hashes for updates (explained in the [Server-Side](#server-side) section).
- Access to the internet to fetch update information from the server or local website to host the php.

## Installation

1. Clone or download the Atualizador Java source code from the repository.

2. Ensure that you have the required Java Development Kit (JDK) installed on your system.

3. Customize the application (if needed) by following the [Customization](#customization) section.

4. Compile the Java source code to generate the executable JAR file.

5. Deploy the JAR file along with any required resources (logo, background image) to your client machines.

## Usage

To use the Atualizador application, follow these steps:

1. Run the Atualizador JAR file on your client machine.

2. The application will display a GUI window with a progress bar indicating "Fazendo atualizações."

3. The application will check for updates by connecting to the server specified in the `updateJsonUrl` variable.

4. If updates are available, it will download and apply them automatically.

5. After the updates are applied, the application will exit, and your software will be up-to-date.

## Customization

You can customize the Atualizador application to fit your branding and requirements:

- **Logo**: Replace the `logo.png` file in the project directory with your own logo.

- **Background**: Replace the `monokai.jpg` file in the project directory with your preferred background image.

- **GUI**: Modify the GUI layout, size, and appearance in the `Atualizador` constructor.

- **ToDo**: Modify what will execute in next in "Process process = Runtime.getRuntime().exec("java\\bin\\java.exe -jar Program.jar");".

## Server-Side

To provide update information to the Atualizador application, you need a server-side script (e.g., PHP) that calculates file hashes and generates a JSON response. Here's a sample PHP script:

```php
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

```

## Troubleshooting

If you encounter any issues while using the Atualizador application, here are some common troubleshooting steps:

1. **Network Issues:** Ensure that the client machine running the Atualizador has an active internet connection to reach the server specified in the `updateJsonUrl` variable.

2. **Server-Side Script:** Double-check your server-side script, making sure it correctly calculates and provides file hashes in the expected JSON format.

3. **Java Environment:** Ensure that the client machine has a properly configured Java Runtime Environment (JRE) or Java Development Kit (JDK) installed.

4. **File Paths:** Verify that the application's JAR file, logo, and background image are in the correct file paths and accessible to the user running the application.

5. **Customization:** If you've customized the Atualizador application, make sure your changes haven't introduced errors in the code.

6. **Logging:** Implement logging in your server-side script and the Atualizador application to capture and diagnose any errors or unexpected behavior.

7. **Permissions:** Ensure that the user running the Atualizador has the necessary permissions to read and write files in the target directory.

If you continue to experience problems, consult the application's documentation or seek assistance from your development or support team.

------------------------------

## Contributing

We welcome contributions to the Atualizador application. If you'd like to get involved, here's how you can contribute:

- **Bug Reports:** If you encounter a bug or unexpected behavior, please open an issue on the project's GitHub repository. Provide details about the issue and steps to reproduce it.

- **Feature Requests:** If you have ideas for new features or improvements, feel free to submit a feature request on the GitHub repository.

- **Pull Requests:** If you've made changes or improvements to the Atualizador application and would like to contribute them, submit a pull request with your changes. Please follow the project's contribution guidelines.

Your contributions help improve the Atualizador application for everyone, and we appreciate your involvement.

------------------------------

## License

The Atualizador application is open-source software released under the MIT License. You are free to use, modify, and distribute it according to the terms of the license. For full license details, please refer to the [LICENSE](LICENSE) file.

Happy updating!
