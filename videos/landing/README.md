# Vídeo de Background - Landing Page

Este diretório contém o vídeo de background usado na seção "Veja Como é Por Dentro" da landing page.

## Como Adicionar o Vídeo

1. **Prepare o vídeo:**
   - Formato: MP4 (H.264) ou WebM
   - Resolução: 1920x1080 (Full HD) ou 3840x2160 (4K)
   - Duração: 10-30 segundos (será em loop)
   - Tamanho: Otimize para web (máximo 5-10MB)
   - Codec: H.264 para MP4, VP9 para WebM

2. **Salve o vídeo** neste diretório com o nome:
   - `background.mp4` (formato principal)
   - `background.webm` (formato alternativo, opcional mas recomendado)

3. **Recomendações:**
   - Vídeo sem áudio (será mutado automaticamente)
   - Movimento suave e sutil (não muito rápido)
   - Cores que combinem com o tema (azul, verde, escuro)
   - Pode ser um vídeo abstrato, partículas, ou animação da interface

4. **Dicas para criação:**
   - Use ferramentas como After Effects, Premiere, ou DaVinci Resolve
   - Exporte em loop perfeito (o último frame deve conectar com o primeiro)
   - Reduza a qualidade se necessário para manter o arquivo pequeno
   - Teste em diferentes dispositivos para garantir performance

## Fallback

Se o vídeo não existir, será exibido apenas o gradiente de fundo padrão, então não é obrigatório ter o vídeo.

## Otimização

Para melhor performance:
- Use HandBrake ou FFmpeg para comprimir
- Exemplo FFmpeg: `ffmpeg -i input.mp4 -vcodec h264 -crf 28 -preset slow background.mp4`
- Exemplo WebM: `ffmpeg -i input.mp4 -vcodec vp9 -crf 30 -b:v 0 background.webm`

