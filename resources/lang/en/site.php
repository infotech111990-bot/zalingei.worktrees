<?php
return App\Locale::where('section_id',1)->pluck('en','var')->toArray();
