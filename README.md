# Football E-Commerce (Maturitní projekt 2023)

Tento projekt je fotbalový e-shop vyvinutý jako maturitní práce v roce 2023. Jde o plně funkční webovou aplikaci, která umožňuje správu uživatelů, produktů, objednávek a skladových zásob. Projekt byl mým prvním komplexním systémem postaveným na PHP a MySQL.

---

## Funkce

### E-shop
- Výpis produktů podle kategorií  
- Detail produktu  
- Přidání do košíku  
- Úprava množství  
- Checkout formulář (jméno, adresa, kontakt, platba, doprava)

### Uživatelé
- Registrace  
- Přihlášení  
- Uživatelská historie objednávek  

### Admin rozhraní
- Správa produktů (přidání, úprava, smazání)  
- Správa skladových zásob (boty, oblečení, doplňky)  
- Správa uživatelů  
- Správa objednávek  

### Sklad & velikosti
- Evidence velikostí bot (36–47)  
- Evidence velikostí oblečení (S–XXL)  
- Množství skladem  
- Automatické odečítání skladu po objednávce  

---

## Použité technologie

- PHP (procedurální)
- MySQL (tabulky, relace, triggery)
- HTML & CSS (vlastní styling)
- XAMPP / Apache pro lokální běh

---

## Databázová struktura

Projekt využívá databázi `e_shop.sql`, která obsahuje:
- produkty  
- popisy  
- velikosti  
- skladové zásoby  
- uživatele  
- objednávky a položky  
- triggery pro automatické mazání navázaných dat  

---

## Co bych dnes udělal jinak

Protože jde o projekt z roku 2023, některé části bych dnes navrhl moderněji:

- použití PDO / MySQLi prepared statements  
- oddělení logiky a šablon (MVC)  
- lepší validace formulářů  
- modernější front-end struktura  
- možnost Docker nasazení  
- optimalizace a refaktorace PHP kódu  

Tento projekt ponechávám jako ukázku svého tehdejšího technického přístupu a vývoje.

---

## Jak spustit projekt

1. Naklonujte repozitář  
2. Importujte databázi `e_shop.sql`  
3. Upravte připojení k databázi v `connect.php`  
4. Spusťte projekt v XAMPP (Apache + MySQL)

---

## Kam jsem se od roku 2023 posunul

Po dokončení tohoto maturitního projektu jsem se výrazně posunul k modernějším technologiím a přístupům.  

Dnes pracuji s:

- **React** (vývoj frontend aplikací)  
- **Node.js** + **Express** (backend)  
- **TypeScript** (silnější typový systém a bezpečnější kód)  
- **PostgreSQL** (relační databáze moderních aplikací)  
- **Moderní architektury** – REST API, plná separace frontendu a backendu  

Tento projekt tu nechávám jako ukázku toho, kde jsem začínal, a jak se moje práce od té doby posunula.

---
