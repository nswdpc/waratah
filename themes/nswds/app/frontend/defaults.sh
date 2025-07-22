#!/usr/bin/env bash
echo 'Creating/updating waratah-branding project defaults'
DEFAULT_PATH=../../../../../../../waratah-branding/frontend/src
mkdir -p $DEFAULT_PATH
touch ${DEFAULT_PATH}/defaults.scss
touch ${DEFAULT_PATH}/app.scss
touch ${DEFAULT_PATH}/app.js
touch ${DEFAULT_PATH}/README.md
echo -e "# Documentation\nSee the branding documentation at https://github.com/nswdpc/waratah/blob/master/docs/en/100_branding.md" > ${DEFAULT_PATH}/README.md
echo 'Completed: waratah-branding project defaults'
