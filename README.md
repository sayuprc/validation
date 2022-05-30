# Validation

バリデーションライブラリ

## 使い方

```php

$request = [
  'name' => 'hoge',
  'age' => 20,
];

$rules = [
  'name' => ['required', 'maxLength:50'],
  'age' => ['required', 'min:0'],
];

$messages = [
  'name' => [
    'required' => '名前を入力してください。'
    'maxLength' => '名前は50文字以内で入力してください。'
  ], 
  'age' => [
    'min' => '年齢は0以上を入力してください。'
  ], 
];

$validator = new \Validation\Validator($request, $rules, $messages);

if (! $validator->validate()) {
  echo implode(PHP_EOL, $validator->errors());
}
```

## ルール一覧

|ルール名|例|説明|
|------------------|---|---|
|required          |'required'|入力必須|
|requiredWith      |'requiredWith:hoge'|指定したキーが存在する場合、入力必須|
|requiredWithAll   |'requiredWithAll:hoge,fuga'|指定したキーがすべて存在する場合、入力必須|
|requiredWithout   |'requiredWithout:hoge'|指定したキーが存在しない場合、入力必須|
|requiredWithoutAll|'requiredWithoutAll:hoge,fuga'|指定したキーがすべて存在しない場合、入力必須|
|string            |'string'|文字列|
|minLength         |'minLength:5'|文字列が指定値以上|
|maxLength         |'maxLength:100'|文字列が指定値以下|
|sameLength        |'sameLength:50'|文字列長が指定値と同じ|
|numeric           |'numeric'|数値|
|min               |'min:5'|数値が指定値以上|
|max               |'min:100'|数値が指定値以下|
|sameSize          |'sameSize:50'|数値が指定値と同じ|
|array             |'array'|配列|
|regex             |'regex:/\A[a-zA-Z0-9]{6}\z/'|正規表現のパターンに一致|
|notRegex          |'notRegex:/\A[a-zA-Z0-9]{6}\z/'|正規表現のパターンに一致しない|
|nullable          |'nullable'|NULLを許容する|