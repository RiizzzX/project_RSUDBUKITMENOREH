# RSUD Bukit Menoreh - Sistem Informasi Farmasi & Antrian

Aplikasi web untuk manajemen antrian dan farmasi di RSUD Bukit Menoreh.

## Teknologi

- **Backend**: PHP 8.1 (Phalcon Framework via Custom Polyfill)
- **Frontend**: HTML5, CSS3, JavaScript
- **Database**: MySQL 8.0
- **Web Server**: Apache 2.4
- **Containerization**: Docker & Docker Compose

## Requirements

- Docker & Docker Compose
- Git
- VS Code (untuk development remote)

## Setup Local Development

### 1. Clone Repository

```bash
git clone https://github.com/RiizzzX/project_RSUDBUKITMENOREH.git
cd project_RSUDBUKITMENOREH
```

### 2. Build & Run Docker

```bash
docker-compose up -d
```

Services akan berjalan di:
- **Web**: http://localhost:8080
- **MySQL**: localhost:3306
- **PHPMyAdmin**: http://localhost:8081

### 3. Akses Aplikasi

```
http://localhost:8080/
```

## VS Code Remote Development

### Setup SSH ke Server

1. **Install Extension**: Remote - SSH (Microsoft)
2. **Configure SSH Host**:
   - Buka Command Palette: `Ctrl+Shift+P`
   - Ketik: `Remote-SSH: Open Configuration File`
   - Tambahkan konfigurasi:

```
Host rsud-server
    HostName [IP_SERVER_ANDA]
    User ubuntu
    IdentityFile ~/.ssh/id_rsa
    Port 22
```

3. **Connect to Server**:
   - Remote Explorer (SSH Targets)
   - Click "Connect to Host"
   - Pilih `rsud-server`

### Deploy ke Server

```bash
# Di server
cd /home/ubuntu
git clone https://github.com/RiizzzX/project_RSUDBUKITMENOREH.git
cd project_RSUDBUKITMENOREH

# Build & run
docker-compose up -d

# Atau dengan production config
docker-compose -f docker-compose.yml up -d
```

## Project Structure

```
new_rsudmenoreh/
├── app/
│   ├── config/              # Configuration & Phalcon Polyfill
│   ├── controllers/         # Controller classes
│   ├── views/              # Phtml templates
│   └── models/             # Model classes
├── public/
│   ├── css/                # Stylesheets
│   ├── js/                 # JavaScript
│   ├── img/                # Images
│   └── index.php           # Entry point
├── docker/                 # Docker setup files
├── Dockerfile              # Docker image config
├── docker-compose.yml      # Multi-container setup
└── php.ini                 # PHP configuration
```

## Features

### Dashboard Antrian
- **Nomor Antrian Live**: Display nomor antrian saat ini dengan design responsif
- **Daftar Antrian Auto-Scroll**: List antrian otomatis scroll ke bawah, kembali ke atas saat selesai
- **Statistik**: Jumlah pasien menunggu & total hari ini
- **Running Text**: Informasi bergulir di bawah
- **Full-Screen Display**: Optimal untuk layar 18"-32"

### Routing

```
GET /              → Halaman Antrian
GET /farmasi       → Manajemen Farmasi
GET /antrian       → Kontrol Antrian
GET /pasien        → Registry Pasien
GET /laporan       → Laporan & Statistik
```

## Database

### Koneksi

```
Host: localhost:3306
User: root
Password: rootpassword
Database: rsud_db
```

### PHPMyAdmin

```
URL: http://localhost:8081
User: root
Password: rootpassword
```

## Phalcon Polyfill

Aplikasi menggunakan custom PHP polyfill untuk Phalcon (tanpa C extension):

- `Di.php` - Dependency Injection
- `Application.php` - MVC Router & Controller Loader
- `View.php` - Template rendering
- `Router.php` - URI routing
- `Config.php` - Configuration management
- `Loader.php` - Autoloader
- `Url.php` - URL helper

Lihat: `app/config/phalcon-polyfill/`

## Responsive Design

Aplikasi support:
- **27" & lebih** (1920px+) - Large desktop
- **24" desktop** (1600px)
- **21-22" desktop** (1440px)
- **18-20" desktop** (1280px+)

## Troubleshooting

### Docker Containers Tidak Jalan

```bash
# Check status
docker ps -a

# View logs
docker logs rsud_web
docker logs rsud_db

# Restart
docker-compose restart
```

### Port 8080 Sudah Terpakai

Edit `docker-compose.yml`:

```yaml
ports:
  - "8090:80"  # Change 8080 to 8090
```

### Database Error

```bash
# Reset database
docker-compose down -v
docker-compose up -d
```

## Deployment Production

### Environment Variables

Create `.env` file:

```
MYSQL_ROOT_PASSWORD=your_secure_password
MYSQL_DATABASE=rsud_production
PHP_MEMORY_LIMIT=512M
```

### Nginx Proxy (Optional)

```nginx
server {
    listen 80;
    server_name rsud.example.com;
    
    location / {
        proxy_pass http://localhost:8080;
        proxy_set_header Host $host;
    }
}
```

## Support & Issues

- Issues: [GitHub Issues](https://github.com/RiizzzX/project_RSUDBUKITMENOREH/issues)
- Email: farizlahya@gmail.com

## License

Private project - RSUD Bukit Menoreh

## Author

- **RiizzzX** - Initial development
- **RSUD Bukit Menoreh Team**

---

Last Updated: January 19, 2026
