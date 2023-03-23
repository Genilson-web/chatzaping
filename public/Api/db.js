
async function connect(){
  if(global.connection && global.connection.state !== 'disconnected')
      return global.connection;

  const mysql = require("mysql2/promise");
  const connection = await mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'wp_wbot'
  });
  // console.log("Conectou no Banco!");
  global.connection = connection;
  return connection;
}
// connect();

async function selectMessages(number){
const conn = await connect();
// const [rows] = await conn.query('SELECT * FROM messages;');
// const [rows] = await conn.query('SELECT * FROM messages INNER JOIN clients ON messages.client_id = clients.id;');
// const [rows] = await conn.query('SELECT client_id, numero, mensagem FROM messages WHERE id = 2;');
// const [rows] = await conn.query('SELECT nome, numero, mensagem FROM messages WHERE id = 2;');
const [rows] = await conn.query(`SELECT nome, numero, mensagem FROM messages WHERE numero = ${number};`);
// conn.end();
return rows;
}
async function selectPergunta(setor_id){
const conn = await connect();
// const [rows] = await conn.query(`SELECT pergunta FROM perguntas WHERE numero = ${number} ORDER BY Id DESC LIMIT 1;`);
const [rows] = await conn.query(`SELECT pergunta,id FROM perguntas WHERE setor_id = ${setor_id};`);
// conn.end();
return rows;
}
async function selectResposta(number){
const conn = await connect();
const [rows] = await conn.query(`SELECT nome, numero, respostas FROM messages WHERE numero = ${number};`);
// conn.end();
return rows;
}
async function selectRespostaInicial(number){
const conn = await connect();
const [rows] = await conn.query(`SELECT resposta FROM resposta_inicials WHERE numero = ${number};`);
// conn.end();
return rows;
}
async function selectSetor(user_id){
const conn = await connect();
const [rows] = await conn.query(`SELECT nome,numero,id FROM setors WHERE user_id = ${user_id};`);
// conn.end();
return rows;
}
async function todosOsSetores(){
const conn = await connect();
const [rows] = await conn.query(`SELECT nome FROM setors`);
// conn.end();
return rows;
}
async function selectAtendentes(setor_id){
const conn = await connect();
const [rows] = await conn.query(`SELECT nome, numero FROM atendentes WHERE setor_id = ${setor_id};`);
// conn.end();
return rows;
}
async function selectNumero(numero){
const conn = await connect();
const [rows] = await conn.query(`SELECT numero,id,user_id FROM numeros WHERE numero = ${numero};`);
// conn.end();
return rows;
}

async function insertMessages(value) 
{
const conn = await connect();
const sql = 'INSERT INTO messages(nome, numero, mensagem) VALUES (?,?,?);';
const values = [value.nome, value.numero, value.mensagem];
await conn.query(sql, values);
// conn.end();
}

module.exports = {selectMessages,insertMessages,selectAtendentes,selectPergunta,selectResposta,
selectSetor,todosOsSetores,selectRespostaInicial,selectNumero}