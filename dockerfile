FROM laravelphp/vapor:php80

RUN apk --update add ffmpeg

RUN apk --update add exiftool
RUN docker-php-ext-configure exif
RUN docker-php-ext-install exif
RUN docker-php-ext-enable exif

COPY . /var/task
