# Daemon Nova - Telegram Bot Management Platform

## Project Overview

Daemon Nova is a comprehensive Laravel-based web application designed as a Telegram bot management platform with advanced analytics capabilities. The application serves as a dashboard system that allows users to manage multiple Telegram channels, schedule and publish content (posts, articles, and advertising), and track performance analytics through an intuitive Filament admin panel interface.

## Key Features

- **Multi-channel Management**: Track and manage multiple Telegram channels with detailed configuration
- **Content Management System**: Handle three types of content:
  - Regular posts with scheduling capabilities
  - Telegraph articles for long-form content
  - Advertising campaigns with tracking
- **Analytics Dashboard**: Comprehensive statistics and visualizations with multiple chart types
- **Telegram Bot Integration**: Direct integration with Telegram's Bot API via Nutgram framework
- **Status Tracking**: Monitor content lifecycle (draft, scheduled, published, failed, archived)
- **Anti-spam Features**: Built-in spam protection and user blocking capabilities
- **Discussion Group Integration**: Support for linking discussion groups to channels

## Architecture

### Core Technologies
- **Framework**: Laravel 12.x
- **Admin Panel**: Filament 4.x with custom schemas and tables
- **Telegram Integration**: Nutgram Laravel package for Bot API communication
- **Charts**: ApexCharts via filament-apex-charts package
- **Database**: PostgreSQL (configurable)
- **Caching**: Redis with Predis
- **Query Caching**: rennokki/laravel-eloquent-query-cache for improved performance
- **Frontend**: Vite, Tailwind CSS 4.x

### Directory Structure
```
app/
├── Filament/
│   ├── Pages/          # Dashboard and other pages
│   ├── Resources/      # Eloquent resources for CRUD operations
│   │   ├── Posts/      # Post management
│   │   ├── Articles/   # Article management
│   │   ├── Advertisings/ # Advertising management
│   │   ├── Channels/   # Channel management
│   │   ├── Tags/       # Tag management
│   │   └── Users/      # User management
│   └── Widgets/        # Dashboard widgets (charts, stats)
├── Http/               # HTTP controllers and requests
│   ├── Controllers/
│   └── Requests/
├── Models/             # Eloquent models (Channel, Post, Article, etc.)
├── Providers/          # Service providers
│   └── Filament/       # Filament panel configuration
├── Telegram/           # Telegram bot handlers
```

### Data Models

#### Channel Model
- Tracks Telegram channel information (ID, username, title, description)
- Manages discussion group integration
- Includes anti-spam configuration (blocked usernames/links, spam protection)
- Tracks member count and view statistics

#### Post Model
- Manages regular content posts
- Includes scheduling, status tracking, and analytics
- Tracks Telegram post ID and external URLs

#### Article Model
- Handles Telegraph articles
- Supports slug-based URLs and author information
- Includes publication tracking and analytics

#### Advertising Model
- Manages advertising campaigns
- Includes expiration tracking and external links
- Supports scheduling and status management

#### User Model
- Standard Laravel authentication
- Query caching enabled

### Database Structure

#### Channels Table
- `telegram_id`: Unique Telegram channel identifier
- `username`: Channel username (nullable, unique)
- `title`: Channel title
- `description`: Channel description
- `invite_link`: Channel invitation link
- `discussion_group_id`: Linked discussion group ID
- `discussion_group_link`: Discussion group link
- `comments_enabled`: Whether comments are enabled
- `anti_spam_enabled`: Anti-spam protection toggle
- `ban_on_link_username`: Whether to ban users posting links/usernames
- `banned_usernames`: JSON array of blocked usernames
- `banned_links`: JSON array of blocked links
- `members_count`: Number of channel members
- `views_total`: Total views across all content
- `last_synced_at`: Timestamp of last sync

#### Posts Table
- `content`: JSON content of the post
- `title`: Post title (unique)
- `description`: Post description
- `published_at`: Scheduled publication date
- `status`: Post status (draft, scheduled, published, failed)
- `telegram_post_id`: Telegram post identifier
- `post_url`: External post URL
- `views`: View count
- `reactions_count`: Reaction count
- `channel_id`: Foreign key linking to channel
- `last_synced_at`: Timestamp of last sync

#### Articles Table
- `content`: JSON content of the article
- `title`: Article title (unique)
- `slug`: URL-friendly slug (unique)
- `description`: Article description
- `author_name`: Article author name
- `author_url`: Article author URL
- `published_at`: Publication date
- `status`: Article status (draft, scheduled, published, failed)
- `telegraph_url`: Telegraph URL
- `views`: View count
- `reactions_count`: Reaction count
- `channel_id`: Foreign key linking to channel
- `last_synced_at`: Timestamp of last sync

#### Advertisings Table
- `content`: JSON content of the ad
- `title`: Ad title (unique)
- `description`: Ad description
- `published_at`: Publication date
- `expires_at`: Expiration date
- `status`: Ad status (draft, scheduled, published, failed, archived)
- `telegram_post_id`: Telegram post ID
- `post_url`: External URL
- `link`: Ad link
- `views`: View count
- `reactions_count`: Reaction count
- `channel_id`: Foreign key linking to channel

## Filament Dashboard Components

### Resources
The application provides full CRUD management for each content type:

#### Posts Resource
- Form schema with title, description, scheduling, status, and analytics
- Table view with search, sorting, and bulk actions
- Create, read, update, delete operations
- Integration with Channel model

#### Articles Resource
- Telegraph-specific fields (slug, author info)
- Complete CRUD operations
- Status management and scheduling

#### Advertisings Resource
- Expiration tracking and ad-specific fields
- Archive functionality
- Campaign management

#### Channels Resource
- Comprehensive channel configuration
- Anti-spam management
- Discussion group linking

### Dashboard Widgets
- **StatsOverview**: Displays summary statistics for channels, posts, articles, ads, views, and reactions
- **ChannelActivityChart**: Visualizes channel activity over time
- **PostsGrowthChart**: Shows growth trends for published content
- **StatusDistributionChart**: Polar area chart showing content status distribution (draft, published, scheduled, failed)
- **TopPostsChart**: Identifies top-performing content
- **ViewsChart**: Tracks view metrics across content types

### Dashboard Layout
- Admin panel accessible at `/admin`
- Login authentication required
- 2-column layout for widgets
- Responsive design with amber primary color

## Telegram Bot Integration

### Configuration
- Telegram bot token configured via environment variable (TELEGRAM_TOKEN)
- Safe mode enabled in production for IP validation
- Routing configured in routes/telegram.php

### Current Handlers
- Basic `/start` command that responds with "Hello, world!"

### Extensibility
- Nutgram framework allows for complex bot interactions
- Commands can be created using `php artisan nutgram:make:command`
- Middleware and conversation patterns supported

## Environment Configuration

The application uses environment variables for configuration (see .env.example):
- Database connection settings (PostgreSQL configured by default)
- Telegram bot token
- Redis and cache settings
- Mail configuration
- Session and queue settings

## Building and Running

### Installation
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install

# Set up environment
cp .env.example .env
php artisan key:generate

# Configure database and run migrations
php artisan migrate

# Build frontend assets
npm run build
```

### Development
```bash
# Run development server with hot reload
npm run dev

# Or use the dev script which runs multiple services
composer run dev
# This starts: Laravel server, queue listener, Pail logs, and Vite dev server

# Alternative: Run services separately
php artisan serve
npm run dev
php artisan queue:listen
```

### Database Migrations
```bash
# Run migrations
php artisan migrate

# Create new migration
php artisan make:migration create_table_name_table
```

### Testing
```bash
# Run tests
composer run test
# or
php artisan test
```

### Telegram Bot Commands
```bash
# Start the bot in webhook mode
php artisan nutgram:run

# List available bot commands
php artisan nutgram:list

# Register bot commands with Telegram
php artisan nutgram:register-commands

# Set webhook URL
php artisan nutgram:hook:set https://yourdomain.com/telegram/webhook

# Get webhook info
php artisan nutgram:hook:info

# Remove webhook
php artisan nutgram:hook:remove
```

## Development Conventions

### Code Style
- Follow Laravel conventions and PSR standards
- Use Eloquent ORM for database interactions
- Leverage Filament PHP framework for admin panel components
- Use Tailwind CSS for styling
- Russian language used in dashboard widgets and labels

### Model Relationships
- Use foreign key constraints with cascade updates/deletes
- Use QueryCacheable trait for improved performance on read-heavy operations
- Cast array fields appropriately (e.g., banned_usernames, banned_links)

### Dashboard Widgets
- Extend appropriate Filament widget classes (StatsOverviewWidget, ApexChartWidget)
- Use Eloquent models for data queries with query caching
- Implement proper error handling and formatting
- Use Russian language for user-facing labels

### Resource Organization
- Use Form Schema classes for form definitions
- Use Table Schema classes for table configurations
- Use Infolist Schema classes for detail views
- Follow consistent field naming and validation

## Key Commands

### Application Setup
- `composer run setup`: Complete setup (install deps, generate key, migrate, build assets)
- `composer run dev`: Start development environment with multiple services
- `composer run test`: Run application tests

### Telegram Bot Management
- `php artisan nutgram:run`: Start Telegram bot in webhook mode
- `php artisan nutgram:list`: List available bot commands
- `php artisan nutgram:register-commands`: Register bot commands with Telegram
- `php artisan nutgram:make:command {name}`: Create new bot command
- `php artisan nutgram:make:conversation {name}`: Create new conversation

### Laravel Standard
- `php artisan migrate`: Run database migrations
- `php artisan db:seed`: Seed the database
- `php artisan config:cache`: Cache configuration
- `php artisan route:cache`: Cache routes
- `php artisan view:cache`: Cache views
- `php artisan optimize`: Optimize the application

### Queue Management
- `php artisan queue:listen`: Listen to queue jobs
- `php artisan queue:work`: Process queue jobs (one-time)

## Security Considerations

- Telegram webhook IP validation in production (safe_mode)
- Environment-based configuration for sensitive data
- Standard Laravel security practices (CSRF protection, etc.)
- Database foreign key constraints for data integrity
- Input validation through Filament forms and Laravel requests
- Authentication required for admin panel access

## Project Notes

- The application name "Daemon Nova" suggests it's a platform for managing multiple aspects of Telegram presence
- Russian language text indicates the primary user base is Russian-speaking
- The application appears designed for content creators, marketing agencies, or businesses managing multiple Telegram channels
- Analytics features suggest it's used for tracking content performance and engagement
- Anti-spam features indicate it's designed to manage active communities
- The architecture separates different types of content (posts, articles, ads) with different lifecycles and properties
- Query caching is used to optimize performance for analytics-heavy operations

## Future Development Areas

Based on the current structure, potential areas for enhancement include:
- More sophisticated Telegram bot interactions beyond the basic start command
- Advanced analytics and reporting features
- User role management and permissions
- Notification systems for content status changes
- Media management for posts and articles
- Integration with additional social platforms
- Advanced scheduling and automation features
- API endpoints for third-party integrations