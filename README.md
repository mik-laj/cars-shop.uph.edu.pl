# Cars-shop.uph.edu.pl
Celem projektu jest zbudowanie serwis WWW tj. sklepu internetowego z samochodami. Wymagane są co najmniej następujące funkcjonalności:
 * możliwość przeglądania ofert
 * możliwości składania zamówienia
 * podgląd stanu zamówienia

## Wymagania
* PHP >5.4
* Node
* MySQL (z kontem `root` bez hasła)

## Uruchomienie
1. Aby zainstalować zależności NodeJS

    ````
npm install
    ````

2. Utwórz baze danych `cars_shop_uph_edu_pl`
3. Wczytaj bazę danych z pliku `database.sql`
4. Uruchom serwer deweloperski i skompiluj zasoby przez polecenie

    ````
gulp
    ````

