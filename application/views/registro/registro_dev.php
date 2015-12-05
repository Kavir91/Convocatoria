<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="span4" id="error">
            <form method="POST" action="<?php echo base_url() ?>index.php/registro/save/">
                <fieldset>
                    <legend>Contact</legend>
                    <label class="control-label" for="name">{$contact_form.name.label} :</label>
                    <input type="text" name="name" id="name" class="required">

                    <label class="control-label" for="email">{$contact_form.email.label} :</label>
                    <input type="text" name="email" id="email" class="required email">

                    <label class="control-label" for="subject">{$contact_form.subject.label} :</label>
                    <input type="text" name="subject" id="subject" class="required">

                    <label class="control-label" for="message">{$contact_form.message.label} :</label>
                    <textarea name="mesage" id="message" cols="45" rows="3" class="required"></textarea>

                    <input type="submit" name="submit" id="submit" value="Submit" class="btn">
                </fieldset>
            </form>
        </div>
    </body>
</html>
