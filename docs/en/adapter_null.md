# Use the NULL adapter

According to the Flysystem [documentation](http://flysystem.thephpleague.com/adapter/null-test/) the Null/Test adapter acts like `/dev/null`, you can only write to it. Reading from it is never possible. Can be useful for writing tests.

```neon
flysystem:
    localAdapter:
        type: null  # This is adapter type definition
```
