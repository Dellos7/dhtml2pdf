
# [dhtml2pdf](https://dellos7.github.io/dhtml2pdf/)

**dhtml2pdf** is a simple, free and very easy to use PHP API that allows you to
see, download or get the binary of the PDF generated from the HTML of an URL.

It uses the [snappy](https://github.com/knplabs/snappy) image & PDF from URL generation PHP library,
which is based in the awesome webkit-based [wkhtmltopdf and wkhtmltoimage](https://wkhtmltopdf.org/) CLI.


Try it out here! :point_right: [https://dhtml2pdf.herokuapp.com/](https://dhtml2pdf.herokuapp.com/)

# The API

Currently, the API is an PHP-based end point which simply
allows you to pass as parameter the URL of the HTML page that you want
to convert to PDF. It's deployed as a [Heroku](https://www.heroku.com/home)
APP so you can use it whenever you want to.

It's as easy as this:

```
https://dhtml2pdf.herokuapp.com/api.php?url=<your_url>&result_type=<result_type>
```

**Params**:

* `url`. The URL of the site you want to convert to PDF. Example: `url=https://www.github.com`
* `result_type`. The way you want to retrieve the generated PDF. Can be
one of the following:
    * `show`. Opens the generated PDF in the browser.
    * `download`. Downloads the generated PDF.
    * `binary`. Returns the binary content of the generated PDF.
* `file_name`. If you choose `download` in the `result_type` parameter,
this is the name of the file that will be downloaded (you must pass the name)
without the **.pdf** extension.

**Example**:

This:
```
https://dhtml2pdf.herokuapp.com/api.php?url=https://www.github.com&result_type=show
```

would open the generated PDF from the `https://www.github.com` site in your browser.

# Examples

## HTML

Anchor to show the PDF in a new browser tab:
```html
<a href="https://dhtml2pdf.herokuapp.com/api.php?url=https://www.github.com&result_type=show" target="_blank">Show PDF</a>
```

Anchor to download the PDF as **my_pdf.pdf**:
```html
<a href="https://dhtml2pdf.herokuapp.com/api.php?url=https://www.github.com&result_type=download&file_name=my_pdf" target="_blank">Download PDF</a>
```

> PRO TIP: Show or download current page in PDF
```html
<a href="javascript:window.open('https://dhtml2pdf.herokuapp.com/api.php?url='+window.location.href+'&result_type=show', '_blank')" target="_blank">Show PDF</a>
```

## jQuery

Retrieve the binary data of the PDF:
```javascript
$.ajax({
    type: "GET",
    url: "https://dhtml2pdf.herokuapp.com/api.php?url=https://www.github.com&&result_type=binary",
    success: function(data){
        //Prints the PDF binary data in the browser console
        console.log(data);
    },
    error: function(err) {
        console.log(err);
    }
});
```

# Deploy your own server API

If you don't want to depend on a external service as this one, you
can easily clone the repo and deploy it in your own server. I will show
how to deploy it in a [Heroku](https://www.heroku.com/home) server as it's easy and fast to install and free!

Clone the repo:

```shell
git clone https://github.com/Dellos7/dhtml2pdf.git
```

```shell
cd dhtml2pdf
```

> If you had any troubles following the below instructions, please visit the
Heroku PHP getting started guide at [https://devcenter.heroku.com/articles/getting-started-with-php#set-up](https://devcenter.heroku.com/articles/getting-started-with-php#set-up)

Sign up in Heroku: [https://signup.heroku.com/](https://signup.heroku.com/)

Download & install Heroku CLI: [https://devcenter.heroku.com/articles/heroku-cli#download-and-install](https://devcenter.heroku.com/articles/heroku-cli#download-and-install)

Login in the Heroku CLI:

```shell
heroku login
```

Create your Heroku APP:

```shell
heroku create <your_app_name>
```

(your APP name will be deployed then in https://<your_app_name>.herokuapp.com)

Update & create the composer dependencies:

```shell
composer update
```

Remove the current git repository and create a Heroku one:

```shell
rm -r .git
git init
git remote add heroku https://git.heroku.com/<your_app_name>.git
git add .
git commit -m "first commit"
```

We only need a last command in order to push our APP to heroku, which
will perform the PHP build and deploy the APP!

```shell
git push -u heroku master
```

# License

[GPL 3.0 License](https://choosealicense.com/licenses/gpl-3.0/)