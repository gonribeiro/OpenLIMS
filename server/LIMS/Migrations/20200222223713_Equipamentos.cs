using System;
using Microsoft.EntityFrameworkCore.Metadata;
using Microsoft.EntityFrameworkCore.Migrations;

namespace LIMS.Migrations
{
    public partial class Equipamentos : Migration
    {
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.AddColumn<string>(
                name: "NotaFiscal",
                table: "Padroes",
                nullable: true);

            migrationBuilder.AddColumn<decimal>(
                name: "Valor",
                table: "Padroes",
                nullable: false,
                defaultValue: 0m);

            migrationBuilder.CreateTable(
                name: "Calibracoes",
                columns: table => new
                {
                    Id = table.Column<int>(nullable: false)
                        .Annotation("MySql:ValueGenerationStrategy", MySqlValueGenerationStrategy.IdentityColumn),
                    Calibrado = table.Column<DateTime>(nullable: false),
                    Validade = table.Column<DateTime>(nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_Calibracoes", x => x.Id);
                });

            migrationBuilder.CreateTable(
                name: "TiposEquipamento",
                columns: table => new
                {
                    Id = table.Column<int>(nullable: false)
                        .Annotation("MySql:ValueGenerationStrategy", MySqlValueGenerationStrategy.IdentityColumn),
                    Tipo = table.Column<string>(nullable: true)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_TiposEquipamento", x => x.Id);
                });

            migrationBuilder.CreateTable(
                name: "Equipamentos",
                columns: table => new
                {
                    Id = table.Column<int>(nullable: false)
                        .Annotation("MySql:ValueGenerationStrategy", MySqlValueGenerationStrategy.IdentityColumn),
                    Nome = table.Column<string>(nullable: true),
                    TipoEquipamentoId = table.Column<int>(nullable: false),
                    CalibracaoId = table.Column<int>(nullable: false),
                    Valor = table.Column<decimal>(nullable: false),
                    NotaFiscal = table.Column<string>(nullable: true),
                    Entrada = table.Column<DateTime>(nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_Equipamentos", x => x.Id);
                    table.ForeignKey(
                        name: "FK_Equipamentos_Calibracoes_CalibracaoId",
                        column: x => x.CalibracaoId,
                        principalTable: "Calibracoes",
                        principalColumn: "Id",
                        onDelete: ReferentialAction.Cascade);
                    table.ForeignKey(
                        name: "FK_Equipamentos_TiposEquipamento_TipoEquipamentoId",
                        column: x => x.TipoEquipamentoId,
                        principalTable: "TiposEquipamento",
                        principalColumn: "Id",
                        onDelete: ReferentialAction.Cascade);
                });

            migrationBuilder.CreateIndex(
                name: "IX_Equipamentos_CalibracaoId",
                table: "Equipamentos",
                column: "CalibracaoId");

            migrationBuilder.CreateIndex(
                name: "IX_Equipamentos_TipoEquipamentoId",
                table: "Equipamentos",
                column: "TipoEquipamentoId");
        }

        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropTable(
                name: "Equipamentos");

            migrationBuilder.DropTable(
                name: "Calibracoes");

            migrationBuilder.DropTable(
                name: "TiposEquipamento");

            migrationBuilder.DropColumn(
                name: "NotaFiscal",
                table: "Padroes");

            migrationBuilder.DropColumn(
                name: "Valor",
                table: "Padroes");
        }
    }
}
