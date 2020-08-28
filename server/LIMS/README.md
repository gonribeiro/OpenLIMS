# Projeto LIMS - Laboratory Information Management System * Para estudo e prática de .Net Core
- LIMS é um sistema de gerenciamento de informações com recursos que suportam as operações de um laboratório.
Este projeto consiste em criar uma representação simplificada do LIMS, com controle de estoque de padrões, soluções e equipamentos laboratoriais.

OBS: Lembrando que eu não sou químico :), sou um profissional de TI que trabalha em um laboratório de química trazendo soluções informatizadas a esses profissionais.
Portanto, havendo alguma discrepância em alguma tela/explicação/etc, você que entende do uso desses materiais e procedimentos, não se assuste :). 
Este projeto não procura ser 100% fiel ao mundo laboratorial, mas procura abordar algumas problemáticas de forma simples com as soluções possíveis. 

// Diagrama do banco de dados: https://dbdiagram.io/d

```
Table Padrao {
  Id int [pk, increment]
  Nome string
  Volume double
  UnidadeId int
  Valor decimal
  NotaFiscal string
  Entrada date
  Validade date
}

Table Solucao {
  Id int [pk, increment]
  PadraoId int
  SolventeId int // solvente (Agua destilada, miliq [alta pura])
  EquipamentoId int
  UnidadeId int
  Volume double
  Entrada date
  Validade date
}

Table Solvente {
  Id int [pk, increment]
  Nome string
}

Table Unidade {
  Id int [pk, increment]
  UN string
}

Table Equipamento {
  Id int [pk, increment]
  Nome string
  TipoEquipamentoId int
  Valor decimal
  NotaFiscal string
  Entrada date
}

Table TipoEquipamento {
  Id int [pk, increment]
  Tipo string
}

Table Calibracao {
  Id int [pk, increment]
  EquipamentoId int
  Calibrado date
  Validade date
}

Table Usuario {
  Id int [pk, increment]
  Nome string
  Usuario string
  Senha string
}

Ref: "Padrao"."UnidadeId" - "Unidade"."Id"

Ref: "Solucao"."UnidadeId" - "Unidade"."Id"

Ref: "Solucao"."PadraoId" - "Padrao"."Id"

Ref: "Equipamento"."CalibracaoId" < "Calibracao"."Id"

Ref: "Equipamento"."TipoEquipamentoId" - "TipoEquipamento"."Id"

Ref: "Solucao"."SolventeId" - "Solvente"."Id"

Ref: "Solucao"."EquipamentoId" - "Equipamento"."Id"
```

# Comandos
- Migrações: https://docs.microsoft.com/pt-br/ef/core/managing-schemas/migrations/?tabs=vs
$ Add-Migration InitialCreate
$ Update-Database
$ Remove-Migration 

# Problemas Resolvidos