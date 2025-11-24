# Flow Realtime Using Background Fetch

A real-time tractor production flow management system built with Laravel and Livewire. This application enables tracking and monitoring of tractor units through different production stages (Mainline, Inspection, and Delivery) using QR code scanning technology with background fetch capabilities.

## 🌟 Features

### Real-time Production Tracking
- **Live Dashboard**: Monitor all tractor units in real-time with automatic data refresh every 60 seconds
- **Production Stage Tracking**: Track tractors through three main stages:
  - **Mainline**: Assembly line tracking and QR scanning
  - **Inspection**: Quality control and inspection checkpoints
  - **Delivery**: Final delivery preparation and dispatch

### QR Code Scanning
- **Live Camera Scanning**: Use device camera for real-time QR code detection
- **File Upload Scanning**: Upload QR code images for scanning
- **Auto-populate Forms**: Automatically fill tractor information from scanned QR codes
- **Background Fetch Support**: Efficient data fetching using modern browser APIs

### Data Management
- **Interactive DataTables**: Sortable, searchable, and paginated tractor listings
- **Real-time Notifications**: Instant alerts when tractors are scanned at different stages
- **Photo Upload**: Capture and store tractor images at each production stage
- **User Attribution**: Track which user scanned each tractor with name and NIK

### User Interface
- **Dark Mode Support**: Full dark/light theme support
- **Responsive Design**: Mobile-first design using Tailwind CSS
- **Modern UI Components**: Built with Livewire Volt for reactive components
- **Intuitive Navigation**: Clean sidebar navigation for easy access to all features

## 🛠️ Technology Stack

### Backend
- **Laravel 12.x**: Modern PHP framework
- **Livewire Volt**: Reactive component framework
- **PHP 8.2+**: Latest PHP features and performance
- **SQLite**: Lightweight database (configurable to MySQL/PostgreSQL)

### Frontend
- **Tailwind CSS 4.x**: Utility-first CSS framework
- **Vite**: Modern build tool and dev server
- **Axios**: HTTP client for API requests
- **Lucide Icons**: Beautiful, consistent icon set
- **QR Scanner Library**: Client-side QR code detection
- **DataTables**: Advanced table features with jQuery

### Development Tools
- **Pest PHP**: Modern testing framework
- **Laravel Pint**: Code style fixer
- **Laravel Debugbar**: Development debugging tools
- **Laravel Sail**: Docker development environment
- **Concurrently**: Run multiple dev servers simultaneously

## 📋 Prerequisites

- PHP 8.2 or higher
- Composer 2.x
- Node.js 18.x or higher
- NPM or Bun package manager
- SQLite (or MySQL/PostgreSQL)
- Web server (Apache/Nginx) or use Laravel's built-in server

## 🚀 Installation

### 1. Clone the Repository
```bash
git clone https://github.com/TUNBudi06/Flow-realtime-using-background-fetch.git
cd Flow-realtime-using-background-fetch
```

### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install
# or if using Bun
bun install
```

### 3. Environment Configuration
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Setup
```bash
# Create SQLite database
touch database/database.sqlite

# Run migrations
php artisan migrate
```

### 5. Storage Setup
```bash
# Create symbolic link for storage
php artisan storage:link
```

### 6. Build Assets
```bash
# Build for production
npm run build

# Or run development server
npm run dev
```

## 🏃 Running the Application

### Development Mode

#### Option 1: Using Composer Scripts (Recommended)
```bash
# Runs Laravel server, queue worker, and Vite dev server concurrently
composer dev
```

This command starts:
- Laravel development server on `http://localhost:8000`
- Queue worker for background jobs
- Vite dev server for hot module replacement

#### Option 2: Manual Start
```bash
# Terminal 1: Start Laravel server
php artisan serve

# Terminal 2: Start queue worker
php artisan queue:work

# Terminal 3: Start Vite dev server
npm run dev
```

### Production Mode
```bash
# Build assets
npm run build

# Serve with optimized settings
php artisan serve --env=production
```

## 📖 Usage Guide

### For Administrators

1. **Access the Application**
   - Navigate to `http://localhost:8000`
   - Login with your credentials

2. **Dashboard Overview**
   - View real-time production statistics
   - Monitor tractor counts by stage (Mainline, Inspection, Delivery)
   - Review latest scanned tractors

3. **Mainline Scanner**
   - Navigate to Mainline section
   - Click "Start QR Scanner" to activate camera
   - Or upload a QR code image
   - Fill in tractor photo
   - Submit to record the tractor exit from mainline

4. **Inspection & Delivery**
   - Similar workflow as Mainline
   - Track tractors through quality control and delivery stages

5. **Data Management**
   - Search and filter tractors in the dashboard
   - Delete records as needed
   - Export data (if configured)

### QR Code Format
The system expects QR codes in the following format:
```
{No};{Date};{Model};{SerialPart1};{SerialPart2};{FullSerial}
Example: 6576;20251023;SF225GWZRE42S;100003;SF225S100003;SF225GWZRE42S100003
```

## 📁 Project Structure

```
Flow-realtime-using-background-fetch/
├── app/
│   ├── Http/
│   │   └── Controllers/         # Application controllers
│   ├── Models/                  # Eloquent models
│   │   └── TractorListModel.php # Main tractor data model
│   └── Providers/               # Service providers
├── database/
│   └── migrations/              # Database migrations
├── public/
│   ├── js/
│   │   ├── DataTables/         # DataTables library
│   │   └── qrScanner/          # QR scanner library
│   └── storage/                # Symbolic link to storage
├── resources/
│   ├── css/                    # Stylesheets
│   ├── js/
│   │   └── app.js              # Main JavaScript file
│   └── views/
│       ├── components/         # Blade components
│       ├── layouts.blade.php   # Main layout
│       ├── livewire/           # Livewire components
│       └── pages/              # Page views
├── routes/
│   └── web.php                 # Web routes
├── composer.json               # PHP dependencies
├── package.json                # Node dependencies
├── vite.config.js              # Vite configuration
└── README.md                   # This file
```

## 🔧 Configuration

### Database Configuration
Edit `.env` file to configure database:
```env
# SQLite (default)
DB_CONNECTION=sqlite

# Or MySQL/PostgreSQL
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=your_database
# DB_USERNAME=your_username
# DB_PASSWORD=your_password
```

### Queue Configuration
```env
QUEUE_CONNECTION=database  # or redis, sqs, etc.
```

### Session Configuration
```env
SESSION_DRIVER=database
SESSION_LIFETIME=120
```

## 🧪 Testing

```bash
# Run all tests
composer test

# Or use Pest directly
./vendor/bin/pest

# Run specific test file
./vendor/bin/pest tests/Feature/ExampleTest.php
```

## 🎨 Code Style

The project uses Laravel Pint for code style:

```bash
# Check code style
./vendor/bin/pint --test

# Fix code style issues
./vendor/bin/pint
```

## 🔐 Security

- User authentication is required for admin features
- CSRF protection enabled on all forms
- File upload validation and sanitization
- XSS protection through Laravel's blade templating

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 👥 Authors

- **TUNBudi06** - *Initial work* - [GitHub Profile](https://github.com/TUNBudi06)

## 🙏 Acknowledgments

- Laravel Framework team
- Livewire team for reactive components
- Tailwind CSS for the styling framework
- QR Scanner library contributors
- ISEKI for the tractor production domain knowledge

## 📞 Support

For issues, questions, or suggestions:
- Open an issue on GitHub
- Check existing issues and discussions
- Review the documentation

## 🗺️ Roadmap

Future enhancements planned:
- [ ] Advanced reporting and analytics
- [ ] Barcode support in addition to QR codes
- [ ] Multi-language support
- [ ] Export functionality (PDF, Excel)
- [ ] Mobile app integration
- [ ] Real-time WebSocket notifications
- [ ] API endpoints for third-party integrations

---

**Note**: This is an active project under development. Features and documentation are subject to change.
