

TODO
====

Summa cart
Remove Add products in shopping cart


Mer kodkvalitet
===
Skapar klasser istället för arrayer. *
Flera argument istället för arrayer *
$user = array("username" => "daniel", "password" => "P@ssw0rd");


Använder Exceptions för felhantering *
http://se1.php.net/manual/en/language.exceptions.php

Använder public, private och protected för att begränsa åtkomst till metoder och medlemsvariabler *
http://php.net/manual/en/language.oop5.visibility.php

Använder inte globala variabler *
http://php.net/manual/en/language.variables.scope.php

Använder inte superglobala variabler för att passa data mellan klasser *
Undviker Strängberoenden *
Protokollberoenden mellan klasser *
$_GET["username"]

Metoder har endast en returtyp *
http://php.net/manual/en/function.strpos.php
http://se2.php.net/manual/en/mysqli.prepare.php

Använder genomgående klasser *
http://www.php.net/manual/en/language.oop5.php

Använder namnrymder (namespaces) *
http://php.net/manual/en/language.namespaces.php

Använder versionshantering *
Duplicerad kod *
Använder loggning *
http://php.net/manual/en/function.error-log.php

Använder assert för att kolla pre/post-conditions i metoder *
http://php.net/manual/en/function.assert.php

Bortkommenterad kod *
Ogiltiga kommentarer *
Endast ett språk *
Använder TODO för att markera åtgärdspunkter *
Alla returvärden är dokumenterade *
Alla parametrar är dokumenterade *
Undantag som kastas är dokumenterade *
Medlemsvariabler är dokumenterade *
Svår kod är dokumenterad *
http://www.phpdoc.org/

Det finns utvecklardokumentation *
Det finns användardokumentation *
Checklista för release finns dokumenterad *