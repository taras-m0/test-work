<?php

/**
 * For membership.
 * User: ttt
 * Date: 23.06.2017
 * Time: 7:48
 */
class controller {
	/** @var  PDO */
	protected $pdo;

	public function __construct(PDO $pdo) {
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->pdo = $pdo;
	}

	/**
	 * @return array
	 */
	public function index(){
		try	{
			$products = $this->pdo->query( 'SELECT * FROM product' );
			$products = $products->fetchAll(PDO::FETCH_ASSOC);

			return array(
				'products' => $products
			);
		}catch (PDOException $e){
			if(preg_match('/Table.*?doesn.?t exist/i', $e->getMessage())){
				// Инициализируем БД при первом старте. Так делать не хорошо, но на тесте можно.
				foreach (preg_split('/\;\s*\n/s', file_get_contents(__DIR__ . '/start.sql')) as $query){
					$query = trim($query);
					if(empty($query)){
						continue;
					}

					$this->pdo->exec( $query );
				}
			}

			header("Location: ");
			exit();
		}
	}

	/**
	 * действие добавления продукта
	 * @param stdClass $data
	 * @return array
	 */
	public function add( stdClass $data ){
		$product = $this->pdo->prepare('INSERT product SET `name` = ?, `description` = ?, `price` = ?');
		$product->execute(array( $data->name, $data->description, $data->price ));
		return array( 'id' => $this->pdo->lastInsertId() );
	}

	/**
	 * действие обновление свойств продукта
	 * @param stdClass $data
	 * @return array
	 */
	public function update( stdClass $data ){
		$product = $this->pdo->prepare('UPDATE product SET `weight` = ?, `width` = ?, `height` = ? WHERE id = ?');
		$product->execute(array( $data->weight, $data->width, $data->height, $data->id ));
		return array( 'id' => $data->id );
	}

	/**
	 * действие удаления продукта
	 * @param stdClass $data
	 * @return array
	 */
	public function delete( stdClass $data ){
		$product = $this->pdo->prepare('DELETE FROM product WHERE id = ? LIMIT 1');
		$product->execute(array( (int) $data->id ));
		return array( 'id' => $data->id );
	}
}