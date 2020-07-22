cd components
mkdir $1
cd $1
touch $1.php
echo '<?php' >> $1.php

cd ../

echo 'import "./'$1'/'$1'.js"' >> index.js
echo '' >> index.php
echo 'include_once NHM_DIR . "/components/'$1'/'$1'.php";' >> index.php