<?php

class QueryBuilder {

	protected $pdo1;
	

	public function __construct($pdo1)
		
		{
			//создаём внутреннюю переменную,присваем ей то,что нам прилетает в pdo1
			$this->pdo = $pdo1;
		}

	
	
	public function getOne($table, $id)
		
		{
			$sql = 'SELECT * FROM posts WHERE id=:id';
			$statement = $this->pdo->prepare($sql);
			$statement->bindValue(':id', $id);
			$statement->execute();
			$result = $statement->fetch(PDO::FETCH_ASSOC);
			return $result;

		}

	

	public function get_all($table) 
		{
		
			$sql = "SELECT * FROM {$table}";
			$statement = $this->pdo->prepare($sql);
			$statement->execute();

			return $statement->fetchAll(PDO::FETCH_ASSOC);
	
		}

	
	
	public function create($table, $data)
		
		{
			$keys = implode(",", array_keys($data));
			$tags = ":" . implode(", :", array_keys($data));

			$sql = "INSERT INTO {$table} ({$keys}) VALUES ({$tags})";

			$statement = $this->pdo->prepare($sql);
			$statement->execute($data);
		}

	
	
	public function update($table, $data, $id)

		{

			//$sql = "UPDATE posts SET title =:title, description=:description WHERE id=:id";
			$keys = array_keys($data);

			$string = '';

			foreach($keys as $key)
				{
				$string .= $key . '=:' . $key . ',';
				}
			$keys = rtrim($string, ',');
			$data['id'] = $id;

			$sql = "UPDATE {$table} SET {$keys} WHERE id=:id";
			$statement = $this->pdo->prepare($sql);
			$statement->bindValue(':id', $id);
			$statement->execute($data);

		}

	
	public function delete($table, $id)
		{

			$sql = "DELETE FROM {$table} WHERE id=:id";
			$statement = $this->pdo->prepare($sql);
			$statement->execute([
				'id' => $id
			]);

		}
	
}
?>
