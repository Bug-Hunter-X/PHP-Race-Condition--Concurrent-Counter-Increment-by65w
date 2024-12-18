This solution uses a mutex lock (using a file lock in this example) to protect the shared counter. Only one process can acquire the lock at a time, preventing race conditions.  The `flock` function ensures exclusive access.  Remember to release the lock (`flock($fp, LOCK_UN);`) even if errors occur to avoid deadlocks.  For more robust solutions in production environments, consider using dedicated locking mechanisms provided by databases or message queues.

```php
<?php
$counterFile = 'counter.txt';
$fp = fopen($counterFile, 'c+'); // Create or open the file for reading and writing
if (flock($fp, LOCK_EX)) { // Acquire an exclusive lock
    $counter = (int)fread($fp, filesize($counterFile)); // Read current count
    $counter++;
    ftruncate($fp, 0); // Clear the file
    fwrite($fp, $counter); // Write the updated count
flock($fp, LOCK_UN); // Release the lock
}
fclose($fp);
echo "Counter value: " . $counter;
?>
```