# ProjectsBook

This application is to maintain Web Project information as a Web Developer. Data will be stored in a MySQL database. Sensitive data like production environment passwords, hosting account, FTP passwords will be encrypted.

## Encryption

Encryption key is setup in <code>config.php</code>. Loose the key, will loose your encrypted data.

## Export Data

All projects data can be exported into html files. Exported files will be stored in <code>/exported/</code> folder. All sensitive data will be decoded and will be on HTML file as plain text. So those exported files **MUST COPY TO SOMEWHERE SECURE AND DELETE** <code>exported</code></span> folder content.
