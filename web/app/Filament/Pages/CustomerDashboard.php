<?php

namespace App\Filament\Pages;

use App\ModulesManager;
use Filament\Pages\Page;

class CustomerDashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-star';

    protected static string $view = 'filament.pages.customer-dashboard';

    protected static ?string $navigationGroup = 'Server Management';

    protected static ?string $navigationLabel = 'Customer Dashboard';

    protected static ?int $navigationSort = 1;

    protected function getViewData(): array
    {
        return [
            'menu' => [

                'email'=>[
                    'title'=>'Email',
                    'icon'=>'turbo_customer-email',
                    'menu'=>[
                        [
                            'title'=>'Email Accounts',
                            'icon'=>'turbo_customer-email-account',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Forwarders',
                            'icon'=>'turbo_customer-email-forwarders',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Email Routing',
                            'icon'=>'turbo_customer-email-routing',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Autoresponders',
                            'icon'=>'turbo_customer-email-autoresponders',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Default Address',
                            'icon'=>'turbo_customer-email-default',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Mailing Lists',
                            'icon'=>'turbo_customer-email-list',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Track Delivery',
                            'icon'=>'turbo_customer-email-track',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Global Email Filters',
                            'icon'=>'turbo_customer-email-global-filter',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Email Filters',
                            'icon'=>'turbo_customer-email-filter',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Email Deliverability',
                            'icon'=>'turbo_customer-email-deliverability',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Address Importer',
                            'icon'=>'turbo_customer-email-importer',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Spam Filters',
                            'icon'=>'turbo_customer-email-spam-filters',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Encryption',
                            'icon'=>'turbo_customer-email-encryption',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'BoxTrapper',
                            'icon'=>'turbo_customer-email-box-trap',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Calendars and Contacts Configuration',
                            'icon'=>'turbo_customer-email-calendar-configuration',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Calendars and Contacts Sharing',
                            'icon'=>'turbo_customer-email-calendar-share',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Calendars and Contacts Management',
                            'icon'=>'turbo_customer-email-calendar-management',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Email Disk Usage',
                            'icon'=>'turbo_customer-email-disk',
                            'link'=>'#'
                        ]
                    ]
                ],

                'billing_and_support'=>[
                    'title'=>'Billing & Support',
                    'icon'=>'turbo_customer-billing',
                    'menu'=>[
                        [
                            'title'=>'News & Announcemnets',
                            'icon'=>'turbo_customer-billing-news-announcement',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Manage Biling Information',
                            'icon'=>'turbo_customer-billing-manage-information',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Download Resources',
                            'icon'=>'turbo_customer-billing-download',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'View Email History',
                            'icon'=>'turbo_customer-billing-history',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'View Invoice History',
                            'icon'=>'turbo_customer-billing-invoice-history',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Search our Knowledgebase',
                            'icon'=>'turbo_customer-billing-search-knowledgebase',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Check Network Status',
                            'icon'=>'turbo_customer-billing-network-status',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'View Billing Information',
                            'icon'=>'turbo_customer-billing-information',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Manage Profile',
                            'icon'=>'turbo_customer-billing-manage-profile',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Register New Domain',
                            'icon'=>'turbo_customer-billing-register-domain',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Transfer a Domain',
                            'icon'=>'turbo_customer-billing-transfer-domain',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Open Ticket',
                            'icon'=>'turbo_customer-billing-open-ticket',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'View Support Tickets',
                            'icon'=>'turbo_customer-billing-support-ticket',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Upgrade/Downgrade',
                            'icon'=>'turbo_customer-billing-update',
                            'link'=>'#'
                        ]
                    ]
                ],

                'files'=>[
                    'title'=>'Files',
                    'icon'=>'turbo_customer-files',
                    'menu'=>[
                        [
                            'title'=>'File Manager',
                            'icon'=>'turbo_customer-file-manager',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Images',
                            'icon'=>'turbo_customer-file-images',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Directory Privacy',
                            'icon'=>'turbo_customer-file-directory-privacy',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Disk Usage',
                            'icon'=>'turbo_customer-file-disk',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Web Disk',
                            'icon'=>'turbo_customer-file-web',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'FTP Accounts',
                            'icon'=>'turbo_customer-file-ftp',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'FTP Connections',
                            'icon'=>'turbo_customer-file-connection',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Backup',
                            'icon'=>'turbo_customer-file-backup',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Backup Wizard',
                            'icon'=>'turbo_customer-file-backup-wizard',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Git Version Control',
                            'icon'=>'turbo_customer-file-git',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'File and Directory Restoration',
                            'icon'=>'turbo_customer-file-directory-restoration',
                            'link'=>'#'
                        ],
                    ]
                ],

                'database'=>[
                    'title'=>'Database',
                    'icon'=>'turbo_customer-database',
                    'menu'=>[
                        [
                            'title'=>'phpMyAdmin',
                            'icon'=>'turbo_customer-database-php',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Manage My Database',
                            'icon'=>'turbo_customer-database-manage',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Database Wizard',
                            'icon'=>'turbo_customer-database-wizard',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Remote Database Access',
                            'icon'=>'turbo_customer-database-remote',
                            'link'=>'#'
                        ]
                    ]
                ],

                'domains'=>[
                    'title'=>'Domains',
                    'icon'=>'turbo_customer-domains',
                    'menu'=>[
                        [
                            'title'=>'WP Toolkit',
                            'icon'=>'turbo_customer-domains-wp',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Site Publisher',
                            'icon'=>'turbo_customer-domains-site',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Sitejet Builder',
                            'icon'=>'turbo_customer-domains-sitejet',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Domains',
                            'icon'=>'turbo_customer-domains-domain',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Redirects',
                            'icon'=>'turbo_customer-domains-redirect',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Zone Editor',
                            'icon'=>'turbo_customer-domains-zone',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Dynamic DNS',
                            'icon'=>'turbo_customer-domains-dynamic',
                            'link'=>'#'
                        ]
                    ]
                ],

                'metrics'=>[
                    'title'=>'Metrics',
                    'icon'=>'turbo_customer-metrics',
                    'menu'=>[
                        [
                            'title'=>'Visitors',
                            'icon'=>'turbo_customer-metrics-visitors',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Site Quality Monitoring',
                            'icon'=>'turbo_customer-metrics-site-quality',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Errors',
                            'icon'=>'turbo_customer-metrics-errors',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Bandwidth',
                            'icon'=>'turbo_customer-metrics-bandwidth',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Raw Access',
                            'icon'=>'turbo_customer-metrics-raw',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Awstats',
                            'icon'=>'turbo_customer-metrics-awstats',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Analog Stats',
                            'icon'=>'turbo_customer-metrics-analog',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Webalizer',
                            'icon'=>'turbo_customer-metrics-webalizer',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Webalizer FTP',
                            'icon'=>'turbo_customer-metrics-webalizer-ftp',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Metrics Editor',
                            'icon'=>'turbo_customer-metrics-editor',
                            'link'=>'#'
                        ]
                    ]
                ],

                'security'=>[
                    'title'=>'Security',
                    'icon'=>'turbo_customer-security',
                    'menu'=>[
                        [
                            'title'=>'SSH Access',
                            'icon'=>'turbo_customer-security-ssh',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'IP Blockers',
                            'icon'=>'turbo_customer-security-block',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'SSL/TLS',
                            'icon'=>'turbo_customer-security-ssl-tls',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Manage API Tokens',
                            'icon'=>'turbo_customer-security-api',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Hotlink Protection',
                            'icon'=>'turbo_customer-security-hotlink',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Leech Protection',
                            'icon'=>'turbo_customer-security-leech',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'SSL/TSL Status',
                            'icon'=>'turbo_customer-security-status',
                            'link'=>'#'
                        ]
                    ]
                ],

                'software'=>[
                    'title'=>'Software',
                    'icon'=>'turbo_customer-software',
                    'menu'=>[
                        [
                            'title'=>'PHP PEAR Packages',
                            'icon'=>'turbo_customer-software-packages',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Perl Modules',
                            'icon'=>'turbo_customer-software-perl',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Site Software',
                            'icon'=>'turbo_customer-software-site',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Optimaze Website',
                            'icon'=>'turbo_customer-software-optimaze',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'MultiPHP Manager',
                            'icon'=>'turbo_customer-software-manager',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'MultiPHP INI Editor',
                            'icon'=>'turbo_customer-software-editor',
                            'link'=>'#'
                        ]
                    ]
                ],

                'advanced'=>[
                    'title'=>'Advanced',
                    'icon'=>'turbo_customer-advanced',
                    'menu'=>[
                        [
                            'title'=>'Cron Jobs',
                            'icon'=>'turbo_customer-advanced-cron',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Track DNS',
                            'icon'=>'turbo_customer-advanced-dns',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Indexes',
                            'icon'=>'turbo_customer-advanced-indexes',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Error Pages',
                            'icon'=>'turbo_customer-advanced-error',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Apache Handlers',
                            'icon'=>'turbo_customer-advanced-apache',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'MIME Types',
                            'icon'=>'turbo_customer-advanced-mime',
                            'link'=>'#'
                        ]
                    ]
                ],

                'preferences'=>[
                    'title'=>'Preferences',
                    'icon'=>'turbo_customer-preferences',
                    'menu'=>[
                        [
                            'title'=>'Password & Security',
                            'icon'=>'turbo_customer-preferences-pass',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Change Language',
                            'icon'=>'turbo_customer-preferences-language',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'Contact Information',
                            'icon'=>'turbo_customer-preferences-contact',
                            'link'=>'#'
                        ],
                        [
                            'title'=>'User Manager',
                            'icon'=>'turbo_customer-preferences-user',
                            'link'=>'#'
                        ]
                    ]
                ]


            ],
        ];

    }
}
