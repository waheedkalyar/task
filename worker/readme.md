The worker is able to the task as mentioned in the description. For running multiple workers parallel there are several approaches and server configurations as discussed below : 

1. **MultiThreading**
   We can introduce multithreading and run the function on several threads so many workers will be running simultaneously.


2. **CRON TASK** We can run worker.php on several command lines by adding to them to cron jobs list and our multiple workers will be running.
   
   
      We can run many times something like this :
   
      exec('php worker/worker.php > /dev/null 2>&1 &');
   
      exec('php worker/worker.php > /dev/null 2>&1 &');


3. **Gearman Workers** We can use gearman workers.

