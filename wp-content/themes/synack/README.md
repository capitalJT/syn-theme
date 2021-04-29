_This is the documentation for the original Synack marketing site theme, which is still in use on some sections of the site._

# WordPress build for Synack

### Team

##### Mike Sawicki - Lead WP Developer ([msawicki@nerdery.com][1])

##### Chris Cheney - Lead Client-Side Developer ([ccheney@nerdery.com][2])

## Setting up statics

This site contains the various build files for front-end assets (JavaScript/CSS/Images). These assets are located in \_statics. The following instructions contains instructions on getting up and running on
the \_statics build process.

1. See README in \_statics folder
2. Typing `grunt themeDisperse --prod` will deploy static assets to theme folder. Do not edit css/JS directly in the wp-content/theme/synack/assets directory.
3. Typing `grunt launch` will run the default task and launch a static http-server

-   `grunt launch --open` will open the static server in your default browser

## WordPress Local Environment Setup

This repository doesn't contain the WordPress core necessary to get a version of the site running locally. We suggest you use WP CLI or download the core files directly from wordpress.org.
Once these core files are downloaded, replace the wp-content directory with this repo's wp-content directory.

## Staging Deployment Process

The production deployment process is outlined at [http://wpengine.com/git/][3]

1. Add a remote origin for production `git remote add staging git@git.wpengine.com:staging/synackv2.git`
2. Deploy changes to production `git push staging master`
3. The \_static directory doesn't have to be in the project. This can be removed after deployment via SFTP or kept in a separate repo all together.

## Production Deployment Process

The production deployment process is outlined at [http://wpengine.com/git/][3]

1. Add a remote origin for production `git remote add production git@git.wpengine.com:production/synackv2.git`
2. Deploy changes to production `git push production master`
3. The \_static directory doesn't have to be in the project. This can be removed after deployment via SFTP or kept in a separate repo all together.

[1]: mailto:msawicki@nerdery.com
[2]: mailto:ccheney@nerdery.com
[3]: http://wpengine.com/git/
