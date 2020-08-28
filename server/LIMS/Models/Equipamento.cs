using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Linq;
using System.Threading.Tasks;

namespace LIMS.Models
{
    public class Equipamento
    {
        public int Id { get; set; }
        [Required]
        public string Nome { get; set; }
        [Required]
        public int TipoEquipamentoId { get; set; }
        public TipoEquipamento TipoEquipamento { get; set; }
        [Required]
        public decimal Valor { get; set; }
        [Required]
        public string NotaFiscal { get; set; }
        public DateTime Create_at { get; set; }
        public DateTime Delete_at { get; set; }
        public List<Calibracao> Calibracao { get; set; }
    }
}