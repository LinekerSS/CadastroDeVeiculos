# Teste fullstack PHP

Leia primeiro todo o projeto, faça sua estimativa de horas para o desenvolvimento e envie um email com o título `[Teste Fullstack PHP] Estimativa` para rh@4.events

Forke este projeto, faça o desenvolvimento e quando finalizar faça um PR aqui. Envie um email com o título `[Teste Fullstack PHP] Finalizado` para rh@4.events com o link do seu PR.

Se você não sabe o que é fazer um "Forke" ou um "PR", pesquise. Valorizamos muito a proatividade.

**Lembre-se: atualize este README informando como instalar e executar seu projeto.**

## Missão backend

Desenvolver uma **API JSON RESTful** em **Swoole PHP ( https://www.swoole.co.uk/ )**, que utilize os métodos `GET` e `POST`.

**Curiosidade:** você sabia que uma API construída em Swoole PHP é mais rápida que Node, Go, Python e qualquer outra stack backend? Se não, descobriu agora :)

### Especificação

Monte uma base de veículo com a seguinte estrutura:

```
veiculo:   string
ano:       integer
descricao: text
vendido:   bool
created:   datetime
```

Utilize **MySQL** para armazenar os dados que a **API** irá consumir. Deixe o export (.sql) do banco de dados junto dos arquivos.

### API endpoints

`GET /veiculos`

Retorna todos os veículos

---

`GET /veiculos/find`

Retorna os veículos de acordo com o termo passado parâmetro `q`

---

`POST /veiculos`

Adiciona um novo veículo


## Missão frontend

Desenvolver uma **UI (User Interface)** de acordo com o desenho que está na pasta [layout], no formato MVC puro, ou seja, não queremos que você use nenhuma framework pronta (Yii, Laravel, etc), é para você mesmo(a) montar o MVC, bem simples.

### Especificação

- Cross browser support (IE11+)
- Consumir **API** criada acima
- Pode usar jQuery a vontade!
- Criar uma tela que tenha...
    - Listagem de veículos
    - Busca
    - Formulário de novo veículo

## Dica

Tudo que for feito em adicional, se for somar ao projeto, contará pontos positivos a você. Agora, cuidado: se você ultrapassar MUITO as horas que estipulou inicialmente, contará muitos pontos NEGATIVOS.

## Dúvida

Se tiver qualquer dúvida sobre esse teste, envie um email com o título `[Teste Fullstack PHP] O assunto que vc deseja` para rh@4.events

<hr>

execute o arquivo em 
~/scripts/database.sql
Banco de dados PHPMyAdmin para criar a tabela.

Configurar o banco em ~/app/Config/Database.php alterando os valores!

## Na pasta raiz do projeto, colocar a api online para o funcionamento dos dados

## Na pasta frontend

Executar o arquivo index.html, usado Angular como framework!
