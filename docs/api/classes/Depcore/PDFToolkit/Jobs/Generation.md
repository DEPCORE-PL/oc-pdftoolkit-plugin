
Generation Job

***

* Full name: `\Depcore\PDFToolkit\Jobs\Generation`
* This class implements:
  `ShouldQueue`

## Properties

### payload

```php
protected array $payload
```

***

### template

```php
protected int $template
```

***

### generateJob

```php
protected int $generateJob
```

***

## Methods

### __construct

__construct a new job instance.

```php
public __construct(array $payload, int $template, int $generateJob): mixed
```

**Parameters:**

| Parameter      | Type      | Description |
|----------------|-----------|-------------|
| `$payload`     | **array** |             |
| `$template`    | **int**   |             |
| `$generateJob` | **int**   |             |

***

### handle

handle the job.

```php
public handle(): void
```

***
