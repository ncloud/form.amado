form.amado
==========

# 소개
이 프로젝트는 한 페이지의 간단한 소개와 입력 폼을 지원하는 웹 소프트웨어입니다.
입력된 폼은 데이터베이스와 구글 스프레드시트에 동시에 저장할 수 있습니다.

## 설치
기본적으로 서버(Apache 또는 Nginx)와 PHP 그리고 설정에 따라 데이터베이스(MySQL)가 필요합니다.
설정은 다운로드하신 폴더의 config.sample.php를 참고하시면 됩니다. (config.php로 변경하시면 더 좋습니다.)

```php
$config['sub_path'] = ''; // 도메인의 하위 폴더에 존재하면 하위 폴더명을 적어주세요 (eg: example.com/folder => folder)
$config['db.use'] = true; // 데이터베이스를 사용할 경우 true 사용안하면 false
$config['db.host'] = '';
$config['db.name'] = '';
$config['db.user'] = '';
$config['db.password'] = '';
    
$config['google.spreadsheet.use'] = true;
$config['google.username'] = '';
$config['google.password'] = '';
$config['google.spreadsheet.key'] = '';
$config['google.worksheet.name'] = '';
```
