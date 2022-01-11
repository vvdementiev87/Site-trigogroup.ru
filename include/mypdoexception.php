<?php
/**
 *  файл mypdoexception.php
 *  
 *  Пользовательский класс является потомком класса Exception
 *  Предназначен только лишь для вывода на экран сообщений 
 *  об ошибках при работе с СУБД
 *  
 */
class MyPDOException extends Exception {
  
  /**
   *  Защищенное свойство, в котором будет храниться 
   *  экземпляр объекта класса PDO
   */
  protected $_pdoObject = NULL;
  
  /**
    *  @brief Частная (закрытая) функция-конструктор класса
   *  
   *  @param [in] $e Объект типа PDOException
   *  @details отображает сообщение об ошибке
   *  
   */
  private function __construct( PDOException $e ) {
    
    // Сохраняем ссылку на объект типа PDOException
    $this->_pdoObject = $e;
    
    // Формируем строку сообщения об ошибке
    $this->_showMessage();
    
  }
  
  /**
    *  @brief Защищенный метод для формирования строки сообщения об ошибке
   *  
   *  @param [in] $string уточненное сообщение об ошибке
   *  
   *  @details формирует строку с html-кодом
   */
  protected function _showMessage( $string = NULL ) {
    
    // Начальный код строки
    $str = "<hr style='color:red' />";
    
    // Если было передано уточненное сообщение, добавляем его, иначе добавим сообщение по умолчанию
    $str .= ( !is_null( $string ) ) ? $string : "При выполнении сценария произошла ошибка:";
    
    // Добавляем сообщение об ошибке из объекта PDOException
    $str .= " <strong>" . $this->_pdoObject->getMessage() . "</strong>";
    
    // Добавляем информацию о строке файла, в которой произошла ошибка, и о самом файле
    $str .= "в строке <strong>" . $this->_pdoObject->getLine() . "</strong> файла <strong>" . $this->_pdoObject->getFile() . "</strong>";
    
    // Формируем блок информации со стеком вызовов
    $str .= "<br>Стек вызовов.";
    
    // Для каждого из таких элементов
    foreach ( $this->_pdoObject->getTrace() as $array ) {
      
      // Добавляем информацию о файле и номере строки в нем
      $str .= "<br>Файл: " . $array[ 'file' ] . " строка: " . $array[ 'line' ];
      
      // Если есть информация о названии функции (метода), класса и операторе доступа, добавляем и их
      if ( !empty( $array[ 'function' ] ) && !empty( $array[ 'class' ] ) && !empty( $array[ 'type' ] ) ) {
        
        $str .= ", в вызове функции (метода): <strong>" . $array[ 'class' ] . $array[ 'type' ] . $array[ 'function' ] . "()</strong>";
        
      }
      
    }
    
    // Закрываем сообщение об ошибке горизонтальной чертой
    $str .= "<hr style='color:red' />";
    
    // Выводим сообщение на экран
    print $str;
    
  }
  
  /**
    *  @brief Статический метод для получения экземпляра этого класса
   *  
   *  @param [in] $e Объект типа PDOException
   *  @return экземпляр этого класса
   *  
   */
  public static function instance( PDOException $e ) {
    
    return new self( $e );
    
  }
  
}
?>