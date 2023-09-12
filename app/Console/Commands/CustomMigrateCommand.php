<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CustomMigrateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:migrate {--fresh : Drop all tables and re-run migrations}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run custom migrations';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if ($this->option('fresh')) {
            $this->call('db:wipe');
            $this->info('Dropped all tables successfully.');
        }
        $this->call('migrate', ['--path' => 'database\migrations\helpers\1023_03_06_052657_create_roles_table.php']);
        $this->call('migrate', ['--path' => 'database\migrations\helpers\1023_04_14_201944_create_genders_table.php']);
        $this->call('migrate', ['--path' => 'database\migrations\helpers\2019_08_19_000000_create_failed_jobs_table.php']);
        $this->call('migrate', ['--path' => 'database\migrations\helpers\2020_06_14_000001_create_media_table.php']);
        $this->call('migrate', ['--path' => 'database\migrations\helpers\2023_01_05_094153_create_media_services_table.php']);
        $this->call('migrate', ['--path' => 'database\migrations\helpers\2023_03_06_052732_create_colors_table.php']);
        $this->call('migrate', ['--path' => 'database\migrations\helpers\2023_03_06_352750_create_tags_table.php']);
        $this->call('migrate', ['--path' => 'database\migrations\helpers\2023_03_06_552846_create_translations_table.php']);
        $this->call('migrate', ['--path' => 'database\migrations\helpers\2023_04_14_201950_create_offer_types_table.php']);
        $this->call('migrate', ['--path' => 'database\migrations\helpers\2023_04_14_202001_create_wilayas_table.php']);
        $this->call('migrate', ['--path' => 'database\migrations\helpers\2023_09_12_152625_create_permissions_table.php']);

        $this->call('migrate', ['--path' => 'database\migrations\user\2014_10_12_000000_create_users_table.php']);
        $this->call('migrate', ['--path' => 'database\migrations\user\2014_10_12_100000_create_password_reset_tokens_table.php']);
        $this->call('migrate', ['--path' => 'database\migrations\user\2019_12_14_000001_create_personal_access_tokens_table.php']);

        $this->call('migrate', ['--path' => 'database\migrations\pets\2023_03_06_052747_create_races_table.php']);
        $this->call('migrate', ['--path' => 'database\migrations\pets\2023_03_06_052748_create_sub_races_table.php']);
        $this->call('migrate', ['--path' => 'database\migrations\pets\2023_03_06_052754_create_pets_table.php']);
        $this->call('migrate', ['--path' => 'database\migrations\pets\2023_09_12_182120_create_pet_losts_table.php']);
        $this->call('migrate', ['--path' => 'database\migrations\pets\2023_09_12_182544_create_pet_metadata_table.php']);
        $this->call('migrate', ['--path' => 'database\migrations\pets\2023_09_12_182549_create_pet_lost_metadata_table.php']);

        $this->call('migrate', ['--path' => 'database\migrations\user\2023_03_06_231641_create_saves_table.php']);
        $this->call('migrate', ['--path' => 'database\migrations\user\2023_09_12_152652_create_notifications_table.php']);
        $this->call('migrate', ['--path' => 'database\migrations\user\2023_09_12_152709_create_chat_sessions_table.php']);
        $this->call('migrate', ['--path' => 'database\migrations\user\2023_09_12_152715_create_chat_messages_table.php']);
        $this->call('migrate', ['--path' => 'database\migrations\user\2023_09_12_152722_create_favorites_table.php']);
        $this->call('migrate', ['--path' => 'database\migrations\user\2023_09_12_152732_create_transaction_histories_table.php']);
        $this->call('migrate', ['--path' => 'database\migrations\user\2023_09_12_152739_create_user_reviews_table.php']);

        $this->call('migrate', ['--path' => 'database\migrations\helpers\2023_09_12_152641_create_audit_logs_table.php']);
    }
}
