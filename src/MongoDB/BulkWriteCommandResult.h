/*
 * Copyright 2024-present MongoDB, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

#ifndef PHONGO_BULKWRITECOMMANDRESULT_H
#define PHONGO_BULKWRITECOMMANDRESULT_H

#include "mongoc/mongoc.h"

#include <php.h>

#include "phongo_structs.h"

php_phongo_bulkwritecommandresult_t* phongo_bulkwritecommandresult_init(zval* return_value, mongoc_bulkwritereturn_t* bw_ret, zval* manager);

#endif /* PHONGO_BULKWRITECOMMANDRESULT_H */
