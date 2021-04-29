### Marketo Template

This folder contains the raw html template used for the custom Marketo landing page that was created to match the new brand aesthetic. To serve/develop this template you can run: `npm run dev:marketo`

This will serve the html file at `localhost:8080/template.html` but will not compile any of the Marketo varialbles so keep in mind the content of the page will change once copied into Marketo.

The reference documentation for how the Marketo template variables system works can be found here: https://docs.marketo.com/display/public/DOCS/Create+a+Guided+Landing+Page+Template

Once edited, the resulting html should be copied in full directly into the target landing page template. You can then create new landing pages elsewhere in Marketo that use this template.
