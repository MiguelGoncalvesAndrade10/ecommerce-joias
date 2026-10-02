# Planejamento da primeira versão — NC Semijoias

Última atualização: 2 de outubro de 2026.
Conversa pausada a pedido do usuário; retomada prevista para 3 de outubro.

## Respostas confirmadas pelo usuário

- Projeto pessoal para portfólio no GitHub e currículo inicialmente, com
  possibilidade de se tornar uma loja real no futuro.
- Nome da marca: NC Semijoias.
- Direção visual: fácil e simples, sem muita sofisticação.
- Recursos desejados: efeito de parallax e navegação por categorias.
- O administrador deve poder registrar vendas e controlar o estoque.
- Prazo esperado: 20 de outubro de 2026.

## Base técnica já preparada

- Tema filho: `wp-content/themes/ecommerce-joias`, configurado e ativo.
- Tema pai: `wp-content/themes/orchid-store`.
- `my-theme` permanece como referência do trabalho anterior.
- Compose ajustado para montar `wp-content` sem sobrepor a pasta do tema filho.
- Estilos do filho carregados após os estilos do pai.

## Ponto de retomada

Estamos definindo o escopo com a skill `grill-me` (entrevista `grilling`), usando
`ask-matt` para orientar a escolha dos próximos fluxos.
O escopo ainda não foi fechado nem aprovado para implementação.

Na próxima rodada, esclarecer as decisões pendentes:

1. Registro de vendas: o administrador lançará vendas presenciais ou por
   WhatsApp além dos pedidos feitos pelo site? Quais dados precisa registrar?
2. Estoque: controle por produto ou também por variações, como tamanho e cor?
   As vendas lançadas pelo administrador devem baixar o mesmo estoque do site?
3. Compra na primeira versão: checkout de demonstração, pagamento manual ou
   integração com pagamento real? Como demonstrar a entrega/frete?
4. Parallax: em qual seção será usado e qual papel terá na página inicial?
5. Catálogo: quais categorias e quantos produtos de exemplo serão necessários?
6. Entrega até 20 de outubro: apenas ambiente local ou também demonstração
   publicada? Quais itens serão obrigatórios e quais poderão ficar para depois?

Investigar primeiro o que o WooCommerce já oferece para pedidos manuais,
categorias e estoque antes de propor funções próprias. Não presumir que é
necessário desenvolver um sistema administrativo separado.

Retomar as perguntas em rodadas, respeitando as dependências entre decisões.
Não iniciar a implementação desse escopo antes de confirmar com o usuário
que chegamos a um entendimento compartilhado.
