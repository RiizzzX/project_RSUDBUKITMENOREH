<!DOCTYPE html>
<html>
<head>
    <title>RSUD Bukit Menoreh - Docker Status</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f5f5f5; }
        .container { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { color: #2ecc71; }
        .success { color: #27ae60; font-weight: bold; }
        .info { background: #ecf0f1; padding: 15px; border-left: 4px solid #3498db; margin: 20px 0; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #3498db; color: white; }
        .btn { display: inline-block; padding: 10px 20px; background: #2ecc71; color: white; text-decoration: none; border-radius: 4px; margin: 5px; }
        .btn:hover { background: #27ae60; }
    </style>
</head>
<body>
    <div class="container">
        <h1>✅ RSUD Bukit Menoreh - Docker Running Successfully!</h1>
        
        <p class="success">🎉 Container sudah aktif dan berjalan dengan baik!</p>
        
        <div class="info">
            <h3>📊 Server Information</h3>
            <table>
                <tr>
                    <th>Component</th>
                    <th>Status</th>
                    <th>Details</th>
                </tr>
                <tr>
                    <td>PHP Version</td>
                    <td class="success">✓ Active</td>
                    <td><?php echo PHP_VERSION; ?></td>
                </tr>
                <tr>
                    <td>Web Server</td>
                    <td class="success">✓ Active</td>
                    <td><?php echo $_SERVER['SERVER_SOFTWARE']; ?></td>
                </tr>
                <tr>
                    <td>Document Root</td>
                    <td class="success">✓ Active</td>
                    <td><?php echo $_SERVER['DOCUMENT_ROOT']; ?></td>
                </tr>
                <tr>
                    <td>MySQL PDO</td>
                    <td class="success">✓ Available</td>
                    <td><?php echo extension_loaded('pdo_mysql') ? 'Installed' : 'Not Installed'; ?></td>
                </tr>
                <tr>
                    <td>XML Extension</td>
                    <td class="success">✓ Available</td>
                    <td><?php echo extension_loaded('xml') ? 'Installed' : 'Not Installed'; ?></td>
                </tr>
            </table>
        </div>

        <div class="info">
            <h3>🔗 Quick Links</h3>
            <a href="/farmasi" class="btn">📊 Farmasi</a>
            <a href="/antrian" class="btn">📋 Antrian</a>
            <a href="http://localhost:8081" class="btn" target="_blank">🗄️ phpMyAdmin</a>
        </div>

        <div class="info">
            <h3>🐳 Docker Services</h3>
            <ul>
                <li><strong>Web Application:</strong> http://localhost:8080</li>
                <li><strong>phpMyAdmin:</strong> http://localhost:8081</li>
                <li><strong>MySQL Database:</strong> localhost:3306</li>
            </ul>
        </div>

        <div class="info">
            <h3>📝 Credentials</h3>
            <table>
                <tr>
                    <th>Service</th>
                    <th>Username</th>
                    <th>Password</th>
                </tr>
                <tr>
                    <td>MySQL Database</td>
                    <td>rsud_user</td>
                    <td>rsud_password</td>
                </tr>
                <tr>
                    <td>phpMyAdmin</td>
                    <td>rsud_user</td>
                    <td>rsud_password</td>
                </tr>
            </table>
        </div>

        <p><small>Server Time: <?php echo date('Y-m-d H:i:s'); ?></small></p>
    </div>
</body>
</html>
