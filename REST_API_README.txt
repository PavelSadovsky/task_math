REST API for test task Mathematics (url: http://pavelsadovsky.pp.ua/)


1) GET  /api/countries, results: JSON with a list of countries.
Example: 
    URL:      http://pavelsadovsky.pp.ua/api/countries/ 
    result:   [{"id_country":"1","country":"Ukraine"}, ... ,{"id_country":"6","country":"Moldova"}]   

	
2) GET  /api/languages, results: JSON with a list of languages
Example: 
    URL:      http://pavelsadovsky.pp.ua/api/languages 
    result:   [{"id_language":"1","language":"Ukranian"}, ... ,{"id_language":"5","language":"English"}] 
	
	
3) GET  /api/cities, results: JSON with a list of cities
Example: 
    URL:      http://pavelsadovsky.pp.ua/api/cities 
    result:   
	[{"id_city":"1","id_country":"1","city":"Kiev","country":"Ukraine"}, ... ,{"id_city":"11","id_country":"6","city":"Kishinev","country":"Moldova"}]

	
4) GET  /api/countries/{ids}/cities/, results: JSON with a list of cities for country

Example for one country: 
    URL:      http://pavelsadovsky.pp.ua/api/countries/1/cities/
    result:   
	[{"id_country":"1","id_city":"1","city":"Kiev"}, ... ,{"id_country":"1","id_city":"3","city":"Odessa"}]
	
Example for several countries:
	URL: 	 http://pavelsadovsky.pp.ua/api/countries/1,2/cities/
	result:   
	[{"id_country":"1","id_city":"1","city":"Kiev"}, ... ,{"id_country":"2","id_city":"8","city":"Warshav"}]
	
	
5) GET  /api/countries/{id}/cities/{ids}/languages, results: JSON with a list languages for talk

Example for one city: 
    URL:      http://pavelsadovsky.pp.ua/api/countries/1/cities/1/languages
    result:   
	[{"id":"1","country":"Ukraine","city":"Kiev","language":"Ukranian"}, ... ,{"id":"3","country":"Ukraine","city":"Kiev","language":"English"}]
	
Example for several cities:
	URL: 	 http://pavelsadovsky.pp.ua/api/countries/1/cities/1,2/languages
	result:   
	[{"id":"1","country":"Ukraine","city":"Kiev","language":"Ukranian"}, ... ,{"id":"4","country":"Ukraine","city":"Dnipro","language":"Ukranian"}]
	
6) Errors:
	GET  /api/aaaa, results: JSON with error, Header: '400 Bad Request'.
Example: 
    URL:      http://pavelsadovsky.pp.ua/api/aaaa/ 
    result:   {"error":"Incorrect request. First element ONLY: 'countries' OR 'cities' OR 'languages'"}"
	
	Others error show similarly.
