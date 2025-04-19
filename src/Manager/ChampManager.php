<?php

namespace PasswordManager\Manager;

use PasswordManager\Champ;
use PasswordManager\User;

class ChampManager extends Manager
{	
	/**
	 * Fonction qui ajoute un champ dans la base de données
	 * 
	 * @param Champ $champ Le champ à ajouter
	 * @param User $user L'utilisateur auquel le champ appartient
	 */
	public function add(Champ $champ, User $user)
	{
		// Insertion du champ
		$insert = $this->db->prepare('INSERT INTO champ (site, email, username, password, description, timestamp, user_id) VALUES(:site, :email, :username, :password, :description, :timestamp, :user_id)');

		$insert->execute([
			'site' => $champ->site(),
			'email' => $champ->email(),
			'username' => $champ->username(),
			'password' => strrev(\encrypt_decrypt('encrypt', $champ->password(), time())),
			'description' => $champ->description(),
			'timestamp' => time(),
			'user_id' => $user->id()
		]);

		// Hydratation du champ avec l'id
		$champ->hydrate(['id' => $this->db->lastInsertId()]);
	}

	/**
	 * Fonction qui permet de récupérer un champ dans la base de données à partir de son id
	 * 
	 * @param int $id L'id du champ
	 * @param User $user l'utilisateur auquel le champ appartient
	 * 
	 * @return Champ Le champ trouvé
	 */
	public function get(int $id, User $user): Champ
	{
		$get = $this->db->prepare('SELECT * FROM champ WHERE id = :id AND user_id = :user_id LIMIT 1');
		$get->execute([
			'id' => $id,
			'user_id' => $user->id()
		]);

		$data = $get->fetch();

		if (!$data) {
			$data = [];
		}

		return new Champ($data);
	}

	/**
	 * Fonction qui permet de modifier un champ dans la base de données
	 * 
	 * @param Champ $champ Le champ avec les nouvelles valeurs
	 */
	public function modify(Champ $champ)
	{
		$modify = $this->db->prepare('UPDATE champ SET site = :site, email = :email, username = :username, password = :password, description = :description WHERE id = :id');
		$modify->execute([
			'id' => $champ->id(),
			'site' => $champ->site(),
			'email' => $champ->email(),
			'username' => $champ->username(),
			'password' => $champ->password(),
			'description' => $champ->description()
		]);
	}

	/**
	 * Fonction qui permet de récupérer tout les champs d'un utlisateur dans la base de données
	 * 
	 * @param User $user L'utilisateur auquel les champs appartiennent
	 * 
	 * @return array Un array avec tout les champs
	 */
	public function getAll(User $user)
	{
		$get = $this->db->prepare('SELECT champ.* FROM champ INNER JOIN users ON champ.user_id = users.id WHERE users.id = :user_id ORDER BY LOWER(site)');
		$get->execute([
			'user_id' => $user->id()
		]);

		// On return un array avec tout les champs
		return $get->fetchAll(\PDO::FETCH_CLASS, 'PasswordManager\Champ');
	}

	/**
	 * Fonction qui permet de supprimer un champ dans la base de données
	 * 
	 * @param int $id L'id du champ
	 * @param User $user L'utilisateur auquel le champ appartient
	 */
	public function delete(int $id, User $user)
	{
		$delete = $this->db->prepare('DELETE FROM champ WHERE champ.id = :champ_id AND champ.user_id = :user_id');
		$delete->execute([
			'champ_id' => $id,
			'user_id' => $user->id()
		]);
	}

	/**
	 * Fonction qui permet de rechercher un champ dans la base de données à partir du nom du site
	 * 
	 * @param string $searchWord Le mot à rechercher
	 * @param User $user L'utilisateur qui fait la recherche
	 */
	public function search(string $searchWord, User $user)
	{
		// On rajoute le % pour LIKE
		$searchWord .= '%';

		$search = $this->db->prepare('SELECT * FROM champ WHERE LOWER(champ.site) LIKE :research AND champ.user_id = :user_id ORDER BY LOWER(site)');
		$search->execute([
			'research' => \strtolower($searchWord),
			'user_id' => $user->id()
		]);

		// On return un array avec tout les champs trouvés
		return $search->fetchAll(\PDO::FETCH_CLASS, 'PasswordManager\Champ');
	}
}
