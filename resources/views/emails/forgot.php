<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Recuperar Senha</title>
</head>
<body style="background-color: #ececec; padding-top: 20px; padding-bottom: 20px;">
<table width="660px" align="center" border="0" bgcolor="#fff">
    <tr>
        <td style="padding: 10px;">
            <h3 style="margin: 0; padding: 0;">Recuperar Senha</h3>
        </td>
    </tr>
    <tr>
        <td style="padding: 10px;">
            <p>Foi feita a solicitação para geração de uma nova senha.</p>
            <p>Para confirmar a geração da nova senha clique no link abaixo:</p>
            <a href="http://localhost:8000/usuarios/check-forgot/<?= isset($codigo) ? $codigo : '' ?>">
                http://localhost:8000/usuarios/check-forgot/<?= isset($codigo) ? $codigo : '' ?>
            </a>
            <p>Caso a solicitação tenha sido feita por engano, ignore este email.</p>
        </td>
    </tr>
    <tr>
        <td style="padding: 10px;">
            Equipe, Gestão Pessoal.
        </td>
    </tr>
</table>
</body>
</html>