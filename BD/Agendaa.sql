UPDATE agenda.`usuarios` SET Clave_Usu=MD5('0987654321') WHERE Nombre_Usu='juan cañarete';
SELECT Cod_Usu, Id_Usu, Nombre_Usu FROM usuarios WHERE Nick_Usu='Juanc' AND Clave_Usu=MD5('0987654321');