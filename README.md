# 介紹
本專案為面試前測，為簡單的部落格CRUD功能API，假設已經安裝完composer

# 建置
指令介面位置在專案根目錄，安裝套件
```sh
composer install
```
生成key
```sh
php artisan key:generate
```

運行服務
```sh
php artisan serve
```
連上 http://localhost:8000/static ，開啟前端操作頁

注意編輯的方式

[![](https://upload.cc/i1/2022/06/09/m0VSWo.png)](https://upload.cc/i1/2022/06/09/m0VSWo.png)




之後連上 http://localhost:8000/api/blog/create 可取得新增文章格式blog
```javascript
{  "author" : string,  "title" : bool,  "content"    : string}
```


# API說明

### 取得公佈欄文章資料

```http
GET /api/blog
```


#### Responses

回傳所有文章

* 格式: blog陣列，每個blog包含id

----
### 取得特定部落格文章資料

```http
GET /api/blog/{id}
```
#### Request
要將{id}替換成該文章的id
#### Responses
回傳某id為{id}的文章

* 格式 : blog，包含id
----
### 新增文章

```http
POST /api/blog
```
#### Request

格式: blog

#### Responses

回傳OK代表成功

----
### 編輯文章

```http
PUT /api/blog/{id}
```
#### Request

要將{id}替換成該文章的id

#### Responses

回傳OK代表成功

----
### 刪除文章

```http
DELETE /api/blog/{id}
```
#### Request

要將{id}替換成該文章的id

#### Responses

回傳OK代表成功



