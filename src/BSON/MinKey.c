/*
 * Copyright 2014-present MongoDB, Inc.
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

#include <php.h>
#include <Zend/zend_interfaces.h>
#include <ext/standard/php_var.h>
#include <zend_smart_str.h>

#ifdef HAVE_CONFIG_H
#include "config.h"
#endif

#include "phongo_compat.h"
#include "php_phongo.h"

zend_class_entry* php_phongo_minkey_ce;

/* {{{ proto void MongoDB\BSON\MinKey::__set_state(array $properties)
*/
static PHP_METHOD(MinKey, __set_state)
{
	zend_error_handling error_handling;
	zval*               array;

	zend_replace_error_handling(EH_THROW, phongo_exception_from_phongo_domain(PHONGO_ERROR_INVALID_ARGUMENT), &error_handling);
	if (zend_parse_parameters(ZEND_NUM_ARGS(), "a", &array) == FAILURE) {
		zend_restore_error_handling(&error_handling);
		return;
	}
	zend_restore_error_handling(&error_handling);

	object_init_ex(return_value, php_phongo_minkey_ce);
} /* }}} */

/* {{{ proto array MongoDB\BSON\MinKey::jsonSerialize()
*/
static PHP_METHOD(MinKey, jsonSerialize)
{
	zend_error_handling error_handling;

	zend_replace_error_handling(EH_THROW, phongo_exception_from_phongo_domain(PHONGO_ERROR_INVALID_ARGUMENT), &error_handling);
	if (zend_parse_parameters_none() == FAILURE) {
		zend_restore_error_handling(&error_handling);
		return;
	}
	zend_restore_error_handling(&error_handling);

	array_init_size(return_value, 1);
	ADD_ASSOC_LONG_EX(return_value, "$minKey", 1);
} /* }}} */

/* {{{ proto string MongoDB\BSON\MinKey::serialize()
*/
static PHP_METHOD(MinKey, serialize)
{
	zend_error_handling error_handling;

	zend_replace_error_handling(EH_THROW, phongo_exception_from_phongo_domain(PHONGO_ERROR_INVALID_ARGUMENT), &error_handling);
	if (zend_parse_parameters_none() == FAILURE) {
		zend_restore_error_handling(&error_handling);
		return;
	}
	zend_restore_error_handling(&error_handling);

	RETURN_STRING("");
} /* }}} */

/* {{{ proto void MongoDB\BSON\MinKey::unserialize(string $serialized)
*/
static PHP_METHOD(MinKey, unserialize)
{
	zend_error_handling error_handling;
	char*               serialized;
	size_t              serialized_len;

	zend_replace_error_handling(EH_THROW, phongo_exception_from_phongo_domain(PHONGO_ERROR_INVALID_ARGUMENT), &error_handling);
	if (zend_parse_parameters(ZEND_NUM_ARGS(), "s", &serialized, &serialized_len) == FAILURE) {
		zend_restore_error_handling(&error_handling);
		return;
	}
	zend_restore_error_handling(&error_handling);
} /* }}} */

/* {{{ MongoDB\BSON\MinKey function entries */
ZEND_BEGIN_ARG_INFO_EX(ai_MinKey___set_state, 0, 0, 1)
	ZEND_ARG_ARRAY_INFO(0, properties, 0)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(ai_MinKey_unserialize, 0, 0, 1)
	ZEND_ARG_INFO(0, serialized)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(ai_MinKey_void, 0, 0, 0)
ZEND_END_ARG_INFO()

static zend_function_entry php_phongo_minkey_me[] = {
	/* clang-format off */
	PHP_ME(MinKey, __set_state, ai_MinKey___set_state, ZEND_ACC_PUBLIC | ZEND_ACC_STATIC)
	PHP_ME(MinKey, jsonSerialize, ai_MinKey_void, ZEND_ACC_PUBLIC | ZEND_ACC_FINAL)
	PHP_ME(MinKey, serialize, ai_MinKey_void, ZEND_ACC_PUBLIC | ZEND_ACC_FINAL)
	PHP_ME(MinKey, unserialize, ai_MinKey_unserialize, ZEND_ACC_PUBLIC | ZEND_ACC_FINAL)
	PHP_FE_END
	/* clang-format on */
};
/* }}} */

/* {{{ MongoDB\BSON\MinKey object handlers */
static zend_object_handlers php_phongo_handler_minkey;

static void php_phongo_minkey_free_object(zend_object* object) /* {{{ */
{
	php_phongo_minkey_t* intern = Z_OBJ_MINKEY(object);

	zend_object_std_dtor(&intern->std);
} /* }}} */

static zend_object* php_phongo_minkey_create_object(zend_class_entry* class_type) /* {{{ */
{
	php_phongo_minkey_t* intern = NULL;

	intern = PHONGO_ALLOC_OBJECT_T(php_phongo_minkey_t, class_type);

	zend_object_std_init(&intern->std, class_type);
	object_properties_init(&intern->std, class_type);

	intern->std.handlers = &php_phongo_handler_minkey;

	return &intern->std;
} /* }}} */
/* }}} */

void php_phongo_minkey_init_ce(INIT_FUNC_ARGS) /* {{{ */
{
	zend_class_entry ce;

	INIT_NS_CLASS_ENTRY(ce, "MongoDB\\BSON", "MinKey", php_phongo_minkey_me);
	php_phongo_minkey_ce                = zend_register_internal_class(&ce);
	php_phongo_minkey_ce->create_object = php_phongo_minkey_create_object;
	PHONGO_CE_FINAL(php_phongo_minkey_ce);

	zend_class_implements(php_phongo_minkey_ce, 1, php_phongo_minkey_interface_ce);
	zend_class_implements(php_phongo_minkey_ce, 1, php_phongo_json_serializable_ce);
	zend_class_implements(php_phongo_minkey_ce, 1, php_phongo_type_ce);
	zend_class_implements(php_phongo_minkey_ce, 1, zend_ce_serializable);

	memcpy(&php_phongo_handler_minkey, phongo_get_std_object_handlers(), sizeof(zend_object_handlers));
	/* Re-assign default handler previously removed in php_phongo.c */
	php_phongo_handler_minkey.clone_obj = zend_objects_clone_obj;
	php_phongo_handler_minkey.free_obj  = php_phongo_minkey_free_object;
	php_phongo_handler_minkey.offset    = XtOffsetOf(php_phongo_minkey_t, std);
} /* }}} */

/*
 * Local variables:
 * tab-width: 4
 * c-basic-offset: 4
 * End:
 * vim600: noet sw=4 ts=4 fdm=marker
 * vim<600: noet sw=4 ts=4
 */
