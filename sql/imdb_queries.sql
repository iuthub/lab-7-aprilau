What are the names of all movies released in 1995?

	SELECT * FROM `movies` WHERE year = 1995;


How many people played a part in the movie ”Lost in Translation”?

	SELECT COUNT(actors.id) FROM actors
	JOIN roles ON actors.id = actor_id
	JOIN movies ON movie_id = movies.id
	WHERE name = "Lost in Translation";


What are the names of all the people who played a part in the movie ”Lost in Translation”?

	SELECT first_name, last_name FROM actors
	JOIN roles ON actors.id = actor_id
	JOIN movies ON movie_id = movies.id
	WHERE name = "Lost in Translation";


Who directed the movie ”Fight Club”?

	SELECT first_name, last_name FROM directors
	JOIN movies_directors ON directors.id = director_id
	JOIN movies ON movies.id = movie_id
	WHERE name = "Fight Club";


How many movies has Clint Eastwood directed?

	SELECT COUNT(movies.id) FROM movies
	JOIN movies_directors ON movies.id = movie_id
	JOIN directors ON directors.id = director_id
	WHERE first_name = "Clint" AND last_name = "Eastwood"


What are the names of all movies Clint Eastwood has directed?

	SELECT movies.name FROM movies
	JOIN movies_directors ON movies.id = movie_id
	JOIN directors ON directors.id = director_id
	WHERE first_name = "Clint" AND last_name = "Eastwood"


What are the names of all directors who have directed at least one horror film?

	SELECT directors.first_name, directors.last_name FROM directors
	WHERE EXISTS (SELECT NULL FROM movies_genres 
	JOIN movies_directors ON movies_genres.movie_id=movies_directors.movie_id
	WHERE genre = "Horror")


What are the names of every actor who has appeared in a movie directed by Christopher Nolan?

	SELECT actors.first_name, actors.last_name FROM actors 
	JOIN roles ON actors.id = actor_id 
	JOIN movies_directors ON movies_directors.movie_id = roles.movie_id 
	JOIN directors ON directors.id = director_id 
	WHERE directors.first_name = "Christopher" AND directors.last_name = "Nolan"
