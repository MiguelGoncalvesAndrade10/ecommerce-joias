# Referências para transições da página inicial

Pesquisa: 7 de outubro de 2026. Escopo: referências oficiais de joalheria para cards de produtos menores e passagem suave entre seções.

## Boucheron

A página inicial organiza uma campanha de coleção, produtos individuais com nome e preço sob consulta, um segundo capítulo editorial e serviços. O conteúdo público também expõe um botão de reprodução na campanha. Essa alternância de narrativa e produtos sustenta a ideia de dar mais presença às seções editoriais e reduzir o peso visual dos cards. [Fonte oficial](https://www.boucheron.com/int_en/).

**Adaptação proposta:** manter imagens editoriais grandes e reduzir a dimensão das vitrines; introduzir cada vitrine com título curto e espaço consistente. Não há medida de tamanho de card ou transição de scroll verificada nesta pesquisa.

## Tiffany & Co.

A página inicial reúne uma campanha HardWear, produtos, categorias, coleções icônicas, estilos populares e serviços. O conteúdo acessível identifica uma animação de progresso representada por um diamante; isso confirma somente a descrição desse indicador, sem demonstrar transições entre seções. [Fonte oficial](https://www.tiffany.com/).

**Adaptação proposta:** estabelecer hierarquia entre campanha, produtos e conteúdo da marca. Cards compactos preservam o ritmo quando a página contém várias vitrines. A redução específica dos cards é uma escolha para este projeto, não uma dimensão copiada do site.

## Van Cleef & Arpels

A página inicial combina campanhas, peças, histórias relacionadas à dança, presentes, categorias e serviços. Há blocos HTML5 de vídeo e um controle explícito para desativar animações no conteúdo público. [Fonte oficial](https://www.vancleefarpels.com/en/home.html).

**Adaptação proposta:** usar um movimento discreto e consistente para títulos e blocos, respeitando a preferência por movimento reduzido. As referências de campanhas e histórias ajudam a tratar as seções como uma sequência editorial.

## Direção recomendada para esta implementação

Estas escolhas são propostas próprias, inspiradas na organização editorial das fontes, e não efeitos comprovados dos sites:

- Reduzir cards de produtos da página inicial, preservando nome, preço e área de interação legíveis. Manter imagens editoriais maiores para diferenciar a campanha da vitrine.
- Aplicar degradês curtos no encontro entre fundos de seções, aproximadamente 32–64 px. As cores devem vir das duas seções adjacentes, sem véu permanente sobre produtos ou textos.
- Revelar discretamente títulos e conteúdo com opacidade e deslocamento vertical curto, aproximadamente 12–20 px em 450–650 ms. Evitar que todos os elementos reapareçam repetidamente ao rolar.
- Usar transição de cor e zoom pequeno nos cards ao passar o cursor; manter o mesmo feedback por foco de teclado.
- Preservar rolagem nativa: sem scroll hijack, travamento de seções ou substituição do gesto de rolar.
- Com movimento reduzido ativado, exibir o conteúdo diretamente. Conteúdo e links também devem permanecer acessíveis caso JavaScript não carregue.

## Adaptação aplicada à NC

A vitrine da home passa a limitar cada card a 216px por padrão, com foto quadrada
e produtos centralizados. Largura, fundos, altura dos degradês e ativação dos dois
efeitos podem ser alterados em **Aparência → Personalizar → Página inicial**.
Os degradês usam 64px por padrão, com entrada de 16px e duração de 650ms nos
conteúdos fora da primeira tela. Cards entram com intervalos curtos de 70ms.
O hero permanece visível desde o carregamento. A mudança de preferência por
movimento reduzido e o foco por teclado tornam os conteúdos imediatamente visíveis.

## Limitações da verificação

Foram abertas as três páginas oficiais e analisado seu conteúdo textual acessível. Não houve captura visual ou execução interativa das animações. Portanto, não se atribuem às marcas efeitos de parallax, reveal, hover, sticky ou degradê entre seções. Campanhas variam por região e data. A adequação visual final deve ser conferida na página deste projeto, em desktop e celular.
