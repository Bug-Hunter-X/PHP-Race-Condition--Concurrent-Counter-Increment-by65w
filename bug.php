This code suffers from a race condition.  Two processes might try to modify the shared resource `$counter` concurrently, leading to unexpected results. For instance, if both processes read the value 0, then increment it, they'll both write 1 back, losing one increment.