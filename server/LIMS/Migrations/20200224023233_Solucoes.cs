using System;
using Microsoft.EntityFrameworkCore.Metadata;
using Microsoft.EntityFrameworkCore.Migrations;

namespace LIMS.Migrations
{
    public partial class Solucoes : Migration
    {
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.CreateTable(
                name: "Solventes",
                columns: table => new
                {
                    Id = table.Column<int>(nullable: false)
                        .Annotation("MySql:ValueGenerationStrategy", MySqlValueGenerationStrategy.IdentityColumn),
                    Nome = table.Column<string>(nullable: true),
                    Delete_at = table.Column<DateTime>(nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_Solventes", x => x.Id);
                });

            migrationBuilder.CreateTable(
                name: "Solucoes",
                columns: table => new
                {
                    Id = table.Column<int>(nullable: false)
                        .Annotation("MySql:ValueGenerationStrategy", MySqlValueGenerationStrategy.IdentityColumn),
                    PadraoId = table.Column<int>(nullable: false),
                    SolventeId = table.Column<int>(nullable: false),
                    EquipamentoId = table.Column<int>(nullable: false),
                    UnidadeId = table.Column<int>(nullable: false),
                    Volume = table.Column<double>(nullable: false),
                    Create_at = table.Column<DateTime>(nullable: false),
                    Validade = table.Column<DateTime>(nullable: false),
                    Delete_at = table.Column<DateTime>(nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_Solucoes", x => x.Id);
                    table.ForeignKey(
                        name: "FK_Solucoes_Equipamentos_EquipamentoId",
                        column: x => x.EquipamentoId,
                        principalTable: "Equipamentos",
                        principalColumn: "Id",
                        onDelete: ReferentialAction.Cascade);
                    table.ForeignKey(
                        name: "FK_Solucoes_Padroes_PadraoId",
                        column: x => x.PadraoId,
                        principalTable: "Padroes",
                        principalColumn: "Id",
                        onDelete: ReferentialAction.Cascade);
                    table.ForeignKey(
                        name: "FK_Solucoes_Solventes_SolventeId",
                        column: x => x.SolventeId,
                        principalTable: "Solventes",
                        principalColumn: "Id",
                        onDelete: ReferentialAction.Cascade);
                    table.ForeignKey(
                        name: "FK_Solucoes_Unidades_UnidadeId",
                        column: x => x.UnidadeId,
                        principalTable: "Unidades",
                        principalColumn: "Id",
                        onDelete: ReferentialAction.Cascade);
                });

            migrationBuilder.CreateIndex(
                name: "IX_Solucoes_EquipamentoId",
                table: "Solucoes",
                column: "EquipamentoId");

            migrationBuilder.CreateIndex(
                name: "IX_Solucoes_PadraoId",
                table: "Solucoes",
                column: "PadraoId");

            migrationBuilder.CreateIndex(
                name: "IX_Solucoes_SolventeId",
                table: "Solucoes",
                column: "SolventeId");

            migrationBuilder.CreateIndex(
                name: "IX_Solucoes_UnidadeId",
                table: "Solucoes",
                column: "UnidadeId");
        }

        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropTable(
                name: "Solucoes");

            migrationBuilder.DropTable(
                name: "Solventes");
        }
    }
}
