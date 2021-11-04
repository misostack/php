<?php
declare(strict_types=1);
// 1. Encapsulation: Each object has its own states & behaviors. In OOP, they are named as "methods & properties"

// Issue 1:
// - Create a class that allow to receive a key then read the current language file that include translation for this key.
// - If the key does not exist, return this key instead of empty/throw error
namespace PHPGuru\Headfirst\OOP;

class TranslationFileLoader {
    private string $filePath;
    private array $translationObjects = [];

    public function __construct($filePath){
        $this->filePath = $filePath;
    }

    /**
     * @return string
     */
    public function getFilePath(): string
    {
        return $this->filePath;
    }

    /**
     * @param  string  $filePath
     */
    public function setFilePath(string $filePath): void
    {
        $this->filePath = $filePath;
    }

    public function loadYamlFile(){
        try{
        $fh = fopen($this->filePath, "r");
        // Output one line until end-of-file
        $lineIndex = 0;
        while(!feof($fh)) {
            $lineIndex++;
            $line = fgets($fh);
            if(empty($line)){
                continue;
            }
            $object = preg_split("/:/", $line);
            if(!$object){
                throw new \Exception(sprintf("Invalid format at line %i", $lineIndex));
            }
            // if everything okie, first element is key, second element is                    
            if(!empty($object[0])){
                preg_match("/\"(.*)\"/", trim($object[1]), $values);
                $this->translationObjects[$object[0]] = $values[1];
            }
        }
        fclose($fh);
        } catch(Exception $exception){
            error_log($exception->getMessage(), 0);
        }
    }

    /**
     * @return array
     */
    public function getTranslationObjects(): array
    {
        return $this->translationObjects;
    }

}

class Translation {
    const SUPPORTED_LANGUAGES = ['en', 'vn'];
    const DEFAULT_LANGUAGE = 'en';
    private $currentLanguage = self::DEFAULT_LANGUAGE;
    private $translationObjects = [];
    private $translationFilePath = './locales';

    /**
     * Translation constructor.
     * @param  string  $currentLanguage
     * @param  array  $translationObjects
     */
    public function __construct(string $currentLanguage, array $translationObjects, string $translationFilePath)
    {
        $this->currentLanguage = $currentLanguage;
        $this->translationObjects = $translationObjects;
        $this->translationFilePath = $translationFilePath;
    }

    /**
     * @return string
     */
    public function getCurrentLanguage(): string
    {
        return $this->currentLanguage;
    }

    /**
     * @param  string  $currentLanguage
     */
    public function setCurrentLanguage(string $currentLanguage): void
    {
        $this->currentLanguage = $currentLanguage;
    }

    /**
     * @return string
     */
    public function getTranslationFilePath(): string
    {
        return $this->translationFilePath;
    }

    /**
     * @param  string  $translationFilePath
     */
    public function setTranslationFilePath(string $translationFilePath): void
    {
        $this->translationFilePath = $translationFilePath;
    }

    public function loadTranslation(){
        // parse translation file content into php array objects
        $translationFileLoader = new TranslationFileLoader($this->translationFilePath . "/" . $this->currentLanguage . ".yaml");
        $translationFileLoader->loadYamlFile();
        $this->translationObjects = $translationFileLoader->getTranslationObjects();
    }

    public function translate($key) {
        return $this->translationObjects[$key] ?? $key;
    }

    public function __destruct()
    {
        // PHP automatically invokes the destructor when the object is deleted or the script is terminated
        echo "Destruct" . PHP_EOL;
    }    
}

class FileType {
    const IMAGE = 'image';
    const PDF = 'pdf';
    const OTHER = 'other';
}

// syntax
// https://vi.wikipedia.org/wiki/T%C3%A1o_t%C3%A2y
class File {
    private string $path;
    private string $type;

    /**
     * @param string $path
     * @param type $type
    */
    public function __construct(string $path, string $type){
        $this->path = $path;
        $this->type = $type;
    }

    public final function getPath(): string {
        return $this->path;
    }

    public function __toString(){
        return "[" . $this->type . "] : " . $this->path;
    }
}

class Image extends File {
    private string $title;
    public function __construct($path, $title = ''){
        $this->title = $title ?? 'Unknown';
        parent::__construct($path, FileType::IMAGE);
    }

    public function renderImageTag() : string{
        return "<img src=\"{$this->getPath()}\" title=\"{$this->title}\" alt=\"{$this->title}\" />";
    }
}


class Fruit {
    private string $name;
    private string $description;
    private array $images = [];

    /**
     * Fruit constructor.
     * @param  string  $name
     * @param  string  $description
     * @param  array  $images
     */
    public function __construct(string $name, string $description, array $images)
    {
        $this->name = $name;
        $this->description = $description;
        $this->images = $images;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param  string  $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param  string  $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return array
     */
    public function getImages(): array
    {
        return $this->images;
    }

    /**
     * @param  array  $images
     */
    public function setImages(array $images): void
    {
        $this->images = $images;
    }

    public function renderHTML(){
        $html = "
            <h1>{$this->name}</h1>
            <p>{$this->description}</p>                        
        ";
        foreach ($this->images as $image){
            $html .= $image->renderImageTag();
        }
        return $html;
    }

}

// abstraction
abstract class DomElement {
    protected string $name;
    protected string $id;
    protected string $value;
    const INPUT_TYPE_TEXT = 'text';
    const INPUT_TYPE_CHECKBOX = 'checkbox';
    const INPUT_TYPE_PASSWORD = 'password';

    abstract protected function render(): string;

}

class InputText extends DomElement {
    public function __construct($id, $name, $value)
    {
        $this->id = $id;
        $this->name = $name;
        $this->value = $value;
    }

    public function render(): string {
        return "<input type=\"text\" name=\"{$this->name}\" id=\"{$this->id}\" value=\"{$this->value}\" />";
    }
}

class InputPassword extends DomElement {
    public function __construct($id, $name, $value)
    {
        $this->id = $id;
        $this->name = $name;
        $this->value = $value;
    }

    public function render(): string {
        return "<input type=\"password\" name=\"{$this->name}\" id=\"{$this->id}\" value=\"{$this->value}\" />";
    }
}

class Checkbox extends DomElement {
    public function __construct($id, $name, $value)
    {
        $this->id = $id;
        $this->name = $name;
        $this->value = $value;
    }

    public function render(): string {
        return "<input type=\"checkbox\" name=\"{$this->name}\" id=\"{$this->id}\" value=\"{$this->value}\" />";
    }
}

class DomFactory {
    public static function createDomElement($type, $id, $name, $value) : DomElement{
        if($type == DomElement::INPUT_TYPE_CHECKBOX) {
             return new Checkbox($id, $name, $value);
        }
        if($type == DomElement::INPUT_TYPE_PASSWORD){
            return new InputPassword($id, $name, $value);
        }
        // default dom element is textbox
        return new InputText($id, $name, $value);
    }
}
// Exercise
interface Account{
    public function getBalance(): int;
    public function updateBalance($amount): void;
}

class UserAccount implements Account {
    private int $balance;

    public function __construct($balance){
        $this->balance = $balance;
    }

    /**
     * @return int
     */
    public function getBalance(): int
    {
        return $this->balance;
    }

    public function updateBalance($amount) : void{
        $this->balance += $amount;
    }
}


trait Logger {
    public function log($value) : void{
        echo str_repeat("-",60) . PHP_EOL;
        echo $value .PHP_EOL;
        echo str_repeat("-",60) . PHP_EOL;
    }
}


interface AccountTransaction {
    const EXPENSE_TRANSACTION_TYPE = 'EXPENSE';
    const INCOME_TRANSACTION_TYPE = 'INCOME';
    public function getTransactionAmount() : int;
    public function __toString(): string;
}

abstract class Transaction {
    use Logger;
    private string $type;
    protected int $amount;
    protected string $created_at;

    protected function __construct($type, $amount, $created_at)
    {
        $this->type = $type;
        $this->amount = $amount;
        $this->created_at = $created_at;
    }

    protected function getType(): string{
        return $this->type;
    }
}

class ExpenseTransaction extends Transaction implements AccountTransaction{
    public function __construct($amount, $created_at){
        parent::__construct(AccountTransaction::EXPENSE_TRANSACTION_TYPE, $amount, $created_at);
    }
    public function getTransactionAmount() : int{
        return $this->amount * -1;
    }
    public function __toString(): string{
        $amount = number_format($this->getTransactionAmount());
        return "[{$this->created_at}]TRANSACTION[{$this->getType()}]: {$amount}";
    }
}

class IncomeTransaction extends Transaction implements AccountTransaction {
    public function __construct($amount, $created_at){
        parent::__construct(AccountTransaction::INCOME_TRANSACTION_TYPE, $amount, $created_at);
    }
    public function getTransactionAmount() : int{
        return $this->amount;
    }
    public function __toString(): string{
        $amount = number_format($this->getTransactionAmount());
        return "[{$this->created_at}]TRANSACTION[{$this->getType()}]: {$amount}";
    }
}

interface ManageAccount {
    public function addTransaction(AccountTransaction $transaction):void;
    public function calculateAccountBalance(AccountTransaction $transaction):void;
    public function queryAccountBalance():void;
}

class ManagePersonalAccount implements ManageAccount {
    use Logger;
    private Account $user_account;
    private array $transactions = [];
    public function __construct(Account $user_account){
        $this->user_account = $user_account;
    }

    public function queryAccountBalance(): void {
        $balance = number_format($this->user_account->getBalance());
        $this->log("Balance: {$balance} VND");
    }

    public function addTransaction(AccountTransaction $transaction): void
    {
        $this->transactions[] = $transaction;
        $this->log($transaction);
        $this->calculateAccountBalance($transaction);
    }

    public function calculateAccountBalance(AccountTransaction $transaction): void
    {
        // TODO: Implement calculateAccountBalance() method.
        $this->user_account->updateBalance($transaction->getTransactionAmount());
    }
}

function oop_solid_principle(){
    // Issue: Write a program to calculate account balance, income, expense
    // Design in this case we have an entity named "Account".
    // Each account have its own balance
    // The transaction can be an income or expense
    // Each transaction must be: amount, transaction type ( income, expense ), created at (date time )
    // An account should have ability to check current balance
    // SINGLE RESPONSIBILITY
    echo "1.SINGLE RESPONSIBILTY" .PHP_EOL;
    echo "\"A class should have one and only one reason to change, meaning that a class have only one job\"";
    try{
        $user_account = new UserAccount(balance:0);
        $manage_personal_account = new ManagePersonalAccount($user_account);
        $manage_personal_account->queryAccountBalance();
        $manage_personal_account->addTransaction(new IncomeTransaction(35000000, '2021-11-04 17:00:00'));
        $manage_personal_account->addTransaction(new ExpenseTransaction(500000, '2021-11-04 17:10:00'));
        $manage_personal_account->addTransaction(new ExpenseTransaction(500000, '2021-11-04 17:10:00'));
        $manage_personal_account->addTransaction(new ExpenseTransaction(500000, '2021-11-04 17:10:00'));
        $manage_personal_account->addTransaction(new ExpenseTransaction(550000, '2021-11-04 17:10:00'));
        $manage_personal_account->addTransaction(new ExpenseTransaction(500000, '2021-11-04 17:10:00'));
        $manage_personal_account->addTransaction(new ExpenseTransaction(500000, '2021-11-04 17:10:00'));
        $manage_personal_account->queryAccountBalance();
    } catch(\Exception $exception){
        die($exception->getMessage());
    }
}

function oop_example(){
    oop_solid_principle();
    return;
    $elements = [];
    $elements[] = DomFactory::createDomElement(DomElement::INPUT_TYPE_TEXT, 'login', 'login','');
    $elements[] = DomFactory::createDomElement(DomElement::INPUT_TYPE_PASSWORD, 'password', 'password','');
    $elements[] = DomFactory::createDomElement(DomElement::INPUT_TYPE_CHECKBOX, 'remember', 'remember','1');

    foreach ($elements as $element){
        echo $element->render() . PHP_EOL;
    }

    $image1 = new Image('image-001.png');
    $image2 =  new Image('image-002.png','Example');
    echo $image1 . PHP_EOL;
    echo $image2 . PHP_EOL;
    echo $image1->renderImageTag();
    echo $image2->renderImageTag();
    $description = <<<EDO
    Example of string
    spanning multiple lines
    using heredoc syntax.
    EDO;

    $apple = new Fruit(name: "Apple", description: $description, images: [$image1,$image2]);
    echo $apple->renderHTML() . PHP_EOL;
}


function oop_main(){
    $currentDirectory = dirname(__FILE__) . '/locales';
    echo "Execute OOP Main" . PHP_EOL;
    oop_example();
    $currentLanguage = 'en';
    $translation = new Translation($currentLanguage, [], $currentDirectory);
    $translation->loadTranslation();
    echo "general.actions.save", ": " ,$translation->translate("general.actions.save") . PHP_EOL;
    $translation->setCurrentLanguage('vn');
    $translation->loadTranslation();    
    echo "general.actions.save", ": " ,$translation->translate("general.actions.save") . PHP_EOL;    
    unset($translation);
    echo "End script" . PHP_EOL;
}
if($_SERVER['SCRIPT_FILENAME'] == __FILE__){
    oop_main();
}