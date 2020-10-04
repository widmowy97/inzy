
### Run cron job every 2 mins

```
SET NAMES utf8mb4;

INSERT INTO `cron_job` (`id`, `name`, `command`, `schedule`, `description`, `enabled`) VALUES
(1, 'sendvisitreminder',  'app:visit-reminder', '*/2 * * * *',  'Run every 2 minutes',  1);
```
