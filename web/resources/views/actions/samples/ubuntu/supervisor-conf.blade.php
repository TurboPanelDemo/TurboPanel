[program:turbo-worker]
process_name=%(program_name)s_%(process_num)02d
command=turbo-php /usr/local/turbo/web/artisan queue:work --sleep=3 --tries=3 --timeout=0
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
user=root
numprocs={{ $workersCount }}
redirect_stderr=true
stdout_logfile=/usr/local/turbo/web/storage/logs/worker.log
stopwaitsecs=3600
