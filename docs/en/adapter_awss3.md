# Use the AwsS3 adapter

This extension has two version of AWS S3 adapters, so you can choose the right one for you.

## AwsS3 v3

At first you have to install `league/flysystem-aws-s3-v3` package via composer:

```sh
$ composer require league/flysystem-aws-s3-v3
```

In order to use the AwsS3v3 adapter, you first need to define AWS client service.
This Flysystem adapter works with the [aws/aws-sdk-php](https://packagist.org/packages/aws/aws-sdk-php) package version 3 and above. This version requires you to use the "v4" of the signature.

```neon
services:
    awss3v3:
        class: Aws\S3\S3Client
        arguments:
            args:
                version: latest     # or '2006-03-01' or other
                region: regionId    # 'eu-central-1' for example
                credentials:
                    key: awsKeyString
                    secret: awsSecretString
```

So now is your AWS client defined and will be created by Nette container generator. So lets define AWS adapter

```neon
flysystem:
    awsAdapter:
        type: awss3v3       # This is adapter type definition
        client: awss3v3     # AWS client service name
        bucket: bucketName  # AWS S3 bucket name
        prefix: somePrefix  # Optional prefix
```

For more info about this adapter, please take a look at the [Flysystem documentation](http://flysystem.thephpleague.com/adapter/aws-s3-v3/).

## AwsS3 v2

At first you have to install `league/flysystem-aws-s3-v2` package via composer:

```sh
$ composer require league/flysystem-aws-s3-v2
```

In order to use the AwsS3v3 adapter, you first need to define AWS client service.
This Flysystem adapter works with the [aws/aws-sdk-php](https://packagist.org/packages/aws/aws-sdk-php) package version ~2.7.

```neon
services:
    awss3v2:
        class: Aws\S3\S3Client
        factory: Aws\S3\S3Client::factory
        arguments:
            args:
                key: awsKeyString
                secret: awsSecretString
```

For the China (Beijing) and EU (Frankfurt) regions, Amazon S3 supports only Signature Version 4, and AWS SDKs use this signature version to authenticate requests.
More in the [AWS docs](http://docs.aws.amazon.com/AmazonS3/latest/dev/UsingAWSSDK.html).

You should add some extras configs options :

```neon
services:
    awss3v2:
        class: Aws\S3\S3Client
        factory: Aws\S3\S3Client::factory
        arguments:
            args:
                key: awsKeyString
                secret: awsSecretString
                signature: v4
                region: region-id           # 'eu-central-1' for example
```

So now is your AWS client defined and will be created by Nette container generator. So lets define AWS adapter

```neon
flysystem:
    awsAdapter:
        type: awss3v2       # This is adapter type definition
        client: awss3v2     # AWS client service name
        bucket: bucketName  # AWS S3 bucket name
        prefix: somePrefix  # Optional prefix
```

For more info about this adapter, please take a look at the [Flysystem documentation](http://flysystem.thephpleague.com/adapter/aws-s3-v2/).
