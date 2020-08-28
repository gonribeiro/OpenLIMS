using System;
using Microsoft.EntityFrameworkCore.Migrations;

namespace LIMS.Migrations
{
    public partial class TimeStamps : Migration
    {
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropColumn(
                name: "Entrada",
                table: "Padroes");

            migrationBuilder.DropColumn(
                name: "Entrada",
                table: "Equipamentos");

            migrationBuilder.AlterColumn<string>(
                name: "UN",
                table: "Unidades",
                nullable: true,
                oldClrType: typeof(string),
                oldType: "longtext CHARACTER SET utf8mb4");

            migrationBuilder.AddColumn<DateTime>(
                name: "Delete_at",
                table: "Unidades",
                nullable: false,
                defaultValue: new DateTime(1, 1, 1, 0, 0, 0, 0, DateTimeKind.Unspecified));

            migrationBuilder.AddColumn<DateTime>(
                name: "Delete_at",
                table: "TiposEquipamento",
                nullable: false,
                defaultValue: new DateTime(1, 1, 1, 0, 0, 0, 0, DateTimeKind.Unspecified));

            migrationBuilder.AddColumn<DateTime>(
                name: "Create_at",
                table: "Padroes",
                nullable: false,
                defaultValue: new DateTime(1, 1, 1, 0, 0, 0, 0, DateTimeKind.Unspecified));

            migrationBuilder.AddColumn<DateTime>(
                name: "Delete_at",
                table: "Padroes",
                nullable: false,
                defaultValue: new DateTime(1, 1, 1, 0, 0, 0, 0, DateTimeKind.Unspecified));

            migrationBuilder.AddColumn<DateTime>(
                name: "Create_at",
                table: "Equipamentos",
                nullable: false,
                defaultValue: new DateTime(1, 1, 1, 0, 0, 0, 0, DateTimeKind.Unspecified));

            migrationBuilder.AddColumn<DateTime>(
                name: "Delete_at",
                table: "Equipamentos",
                nullable: false,
                defaultValue: new DateTime(1, 1, 1, 0, 0, 0, 0, DateTimeKind.Unspecified));

            migrationBuilder.AddColumn<DateTime>(
                name: "Delete_at",
                table: "Calibracoes",
                nullable: false,
                defaultValue: new DateTime(1, 1, 1, 0, 0, 0, 0, DateTimeKind.Unspecified));
        }

        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropColumn(
                name: "Delete_at",
                table: "Unidades");

            migrationBuilder.DropColumn(
                name: "Delete_at",
                table: "TiposEquipamento");

            migrationBuilder.DropColumn(
                name: "Create_at",
                table: "Padroes");

            migrationBuilder.DropColumn(
                name: "Delete_at",
                table: "Padroes");

            migrationBuilder.DropColumn(
                name: "Create_at",
                table: "Equipamentos");

            migrationBuilder.DropColumn(
                name: "Delete_at",
                table: "Equipamentos");

            migrationBuilder.DropColumn(
                name: "Delete_at",
                table: "Calibracoes");

            migrationBuilder.AlterColumn<string>(
                name: "UN",
                table: "Unidades",
                type: "longtext CHARACTER SET utf8mb4",
                nullable: false,
                oldClrType: typeof(string),
                oldNullable: true);

            migrationBuilder.AddColumn<DateTime>(
                name: "Entrada",
                table: "Padroes",
                type: "datetime(6)",
                nullable: false,
                defaultValue: new DateTime(1, 1, 1, 0, 0, 0, 0, DateTimeKind.Unspecified));

            migrationBuilder.AddColumn<DateTime>(
                name: "Entrada",
                table: "Equipamentos",
                type: "datetime(6)",
                nullable: false,
                defaultValue: new DateTime(1, 1, 1, 0, 0, 0, 0, DateTimeKind.Unspecified));
        }
    }
}
