# 📁 Silverstripe Road Reporting Project Structure

```
nzta-road-reporting/
├── app/                             # Silverstripe main application directory (can be src/ or app/)
│   ├── _config/                     # Project-specific configuration YAML files
│   │   └── config.yml               # Module/service configuration
│   ├── Controllers/                 # Custom page and form controllers
│   │   └── ReportController.php     # Handles front-end report form logic
│   ├── Models/                      # DataObject definitions
│   │   ├── Report.php               # Main Report model
│   │   ├── ReportType.php           # Problem category (e.g. pothole, signage)
│   │   └── ReportImage.php          # Related images
│   ├── Admin/                       # CMS admin interfaces (ModelAdmin)
│   │   └── ReportAdmin.php          # Registers report model in CMS
│   └── Pages/                       # Optional Page types if routing through CMS
│       └── ReportPage.php           # Page that holds the form
├── public/                          # Web root directory
│   ├── resources/                   # Compiled CSS/JS assets
│   └── index.php                    # Silverstripe entry point
├── themes/
│   └── custom/
│       ├── templates/               # .ss frontend templates
│       │   └── Layout/
│       │       └── ReportForm.ss    # Custom form display
│       └── scss/                    # SCSS stylesheets
│           └── style.scss
├── .env                             # Environment config (DB, admin user, etc.)
├── composer.json                   # Project dependencies
├── composer.lock
└── README.md                        # Project documentation

```
