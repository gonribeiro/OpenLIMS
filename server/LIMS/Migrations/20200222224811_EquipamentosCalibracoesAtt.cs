using Microsoft.EntityFrameworkCore.Migrations;

namespace LIMS.Migrations
{
    public partial class EquipamentosCalibracoesAtt : Migration
    {
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropForeignKey(
                name: "FK_Equipamentos_Calibracoes_CalibracaoId",
                table: "Equipamentos");

            migrationBuilder.DropIndex(
                name: "IX_Equipamentos_CalibracaoId",
                table: "Equipamentos");

            migrationBuilder.DropColumn(
                name: "CalibracaoId",
                table: "Equipamentos");

            migrationBuilder.AddColumn<int>(
                name: "EquipamentoId",
                table: "Calibracoes",
                nullable: false,
                defaultValue: 0);

            migrationBuilder.CreateIndex(
                name: "IX_Calibracoes_EquipamentoId",
                table: "Calibracoes",
                column: "EquipamentoId");

            migrationBuilder.AddForeignKey(
                name: "FK_Calibracoes_Equipamentos_EquipamentoId",
                table: "Calibracoes",
                column: "EquipamentoId",
                principalTable: "Equipamentos",
                principalColumn: "Id",
                onDelete: ReferentialAction.Cascade);
        }

        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropForeignKey(
                name: "FK_Calibracoes_Equipamentos_EquipamentoId",
                table: "Calibracoes");

            migrationBuilder.DropIndex(
                name: "IX_Calibracoes_EquipamentoId",
                table: "Calibracoes");

            migrationBuilder.DropColumn(
                name: "EquipamentoId",
                table: "Calibracoes");

            migrationBuilder.AddColumn<int>(
                name: "CalibracaoId",
                table: "Equipamentos",
                type: "int",
                nullable: false,
                defaultValue: 0);

            migrationBuilder.CreateIndex(
                name: "IX_Equipamentos_CalibracaoId",
                table: "Equipamentos",
                column: "CalibracaoId");

            migrationBuilder.AddForeignKey(
                name: "FK_Equipamentos_Calibracoes_CalibracaoId",
                table: "Equipamentos",
                column: "CalibracaoId",
                principalTable: "Calibracoes",
                principalColumn: "Id",
                onDelete: ReferentialAction.Cascade);
        }
    }
}
