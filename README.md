# E-commerce de Joias

Projeto guia desenvolvido durante meus estudos de Engenharia de Software.

## Objetivo

Desenvolver e evoluir um e-commerce de joias aplicando, na prática, os conceitos estudados de engenharia de software.

## Tecnologias

- WordPress
- WooCommerce
- Git e GitHub
- Docker Compose
- Tema filho personalizado baseado no Orchid Store

## Desenvolvimento do tema

O tema da loja fica em `wp-content/themes/ecommerce-joias` e herda o Orchid Store,
que deve permanecer instalado em `wp-content/themes/orchid-store`.
A pasta `my-theme` guarda apenas o trabalho anterior como referência.

Para iniciar o ambiente ou aplicar a alteração das montagens do Compose:

```bash
docker compose up -d
```

Em um clone novo, conclua a instalação do WordPress e instale pelo painel o
tema **Orchid Store** (Aparência → Temas → Adicionar tema) e o plugin
**WooCommerce** (Plugins → Adicionar plugin). Esses componentes de terceiros,
uploads e traduções não são versionados; o Git guarda o tema próprio.
O banco de dados fica no volume Docker local e também não acompanha o clone.
As credenciais do Compose são destinadas apenas ao ambiente de desenvolvimento.

Acesse `http://localhost:8080/wp-admin` e, em **Aparência → Temas**, ative
**Ecommerce Joias**. O Orchid Store deve permanecer instalado, mas o tema ativo
será o filho. A ativação pode exigir reconfigurar menus, widgets e opções visuais
anteriormente configurados em outro tema.

- `style.css`: identidade visual e estilos próprios, carregados após o CSS do pai.
  A versão do arquivo usa sua data de alteração para atualizar o cache do navegador.
- `functions.php`: funções próprias, ações e filtros. Use o prefixo
  `ecommerce_joias_` nas funções para evitar conflitos com o tema pai.
- Para alterar um template, copie somente o arquivo necessário do Orchid Store
  para o filho, mantendo o caminho relativo, e edite a cópia. Templates do
  WooCommerce ficam em `woocommerce/` dentro do filho e precisam ser revisados
  quando o plugin atualizar esses templates.

Os templates ausentes no filho são herdados do pai. O `functions.php` do filho
e o do pai são carregados pelo WordPress; não copie o `functions.php` do pai.
Para modificar hooks registrados pelo pai, faça isso em um hook posterior,
como `after_setup_theme`, com prioridade adequada.

Produtos, textos, imagens, menus e opções disponíveis no Personalizador são
gerenciados no painel do WordPress. Regras de negócio que precisam continuar
funcionando ao trocar de tema devem ficar em um plugin próprio.
