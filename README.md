# maguttiCms
GFStudio laravel CMS

# V 5.5.4

a### Image Responsive Usage Sample
```
{!! HtmlHelper::setHtmlTagAttributes(['alt' => '', 'class' => 'img-fluid'])->get_responsive($article->image) !!}
```

### Enable HTTPS
- set APP_HTTPS=true in .env file

### Enable FileManager
To enable the filemanager you have to:
- Add the field in fillable array;
- Create an image field with parameter ```'filemanager' => 1```
- Create the imageMedia relationship:
```
public function imageMedia()
{
  return $this->hasOne('App\Media','id','image');
}
```

License
=======
Code released under the MIT license


HTTPS in uso:
Versione PHP in uso:
Versione MySQL in uso:
Librerie aggiuntive PHP installate: Nessuna
Librerie aggiuntive Server installate: Nessuna
Accessi FTP per clienti:
